<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployersController extends Controller
{
    public function index()
    {
        $employers = Employer::paginate(10);
        return view('admin.employers.index', ['employers' => $employers]);
    }

    public function create()
    {
        return view('admin.employers.create');
    }

    public function store(Request $request)
    {

    }

    public function show(Employer $employer)
    {
        return view('admin.employers.show', ['employer' => $employer]);
    }

    public function edit(Employer $employer)
    {
        return view('admin.employers.edit', ['employer' => $employer]);
    }

    public function update(Request $request, Employer $employer)
    {

    }

    /**
     * @param Employer $employer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Employer $employer): RedirectResponse
    {
        $employer->delete();
        $employer->user()->delete();
        $employer->jobs()->delete();
        return redirect()->route('admin.employers')
            ->with('success', 'Employer deleted successfully');
    }
}
