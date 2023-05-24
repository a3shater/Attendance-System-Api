<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Resources\Company as CompanyResource;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = CompanyResource::collection(Company::all());
        return $company->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Company::class);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('companies');
        }
        $company = new CompanyResource(Company::create($data));

        return $company->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = new CompanyResource(Company::findOrFail($id));
        return $company->response()->setStatusCode(200, 'successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idCompany = Company::findOrFail($id);
        $this->authorize('update', $idCompany);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('companies');
        }

        $company = new CompanyResource(Company::findOrFail($id));

        $company->update($data);

        return $company->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idCompany = Company::findOrFail($id);
        $this->authorize('delete', $idCompany);

        Company::findOrFail($id)->delete();
        return response()->json(200);
    }
}
