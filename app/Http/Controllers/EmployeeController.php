<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use illuminate\View\View;
use Illuminate\Support\Carbon;

class EmployeeController extends Controller
{
    //
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $employees = Employee::where('nama', 'like', "%$search%")
                         ->orWhere('jabatan', 'like', "%$search%")
                         ->orWhere('alamat', 'like', "%$search%")
                         ->latest()
                         ->paginate(5);

        // Menambahkan data umur berdasarkan tanggal_lahir
        foreach ($employees as $employee) {
            $tanggalLahir = Carbon::parse($employee->tanggal_lahir);
            $umur = $tanggalLahir->diffInYears(Carbon::now());
            $employee->umur = $umur;
        }

        return view('employees.index', compact('employees', 'search'));
    }

    public function create(): View
    {
        return view('employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required|min:10',
            'jabatan'  => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);

        //create employees
        Employee::create([
            'nama'     => $request->nama,
            'jabatan'     => $request->jabatan,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        //redirect to index
        return redirect()->route('employees.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        //get employees by ID
        $employee = Employee::findOrFail($id);

        //render view with employees
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required|min:10',
            'jabatan'  => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);

        //get employee by ID
        $employee = Employee::findOrFail($id);

        //update employee without image
        $employee->update([
            'nama'     => $request->nama,
            'jabatan'     => $request->jabatan,
            'tanggal_lahir'   => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        //redirect to index
        return redirect()->route('employees.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get employee by ID
        $employee = Employee::findOrFail($id);

        //delete employee
        $employee->delete();

        //redirect to index
        return redirect()->route('employees.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
