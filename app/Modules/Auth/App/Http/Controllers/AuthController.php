<?php

namespace Modules\Auth\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Modules\Auth\App\Http\Requests\UserRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth::index');
    }

    /**
     * Show the form for creating a new resource.
     */
	  public function auth(UserRequest $request): RedirectResponse
        {
        try {
			
            
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
				return redirect()->route('admin_index')->with('success', trans('messages.auth.successMessage'));
            }
			
            return redirect()->route('login')->with('error', trans('messages.auth.errorMessage'));
        } catch (Exception) {
            return redirect()->route('login')->with('error', trans('messages.auth.errorException'));
        }
    }
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
