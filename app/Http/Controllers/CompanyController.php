<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $company = Company::create($validated);
            $company->user()->create([
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            throw $e;
        }

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $company->update($validated);

            $userData = [];
            if (isset($validated['email'])) {
                $userData['email'] = $validated['email'];
            }

            if (isset($validated['password'])) {
                $userData['password'] = bcrypt($validated['password']);
            }

            if (count($userData) > 0) {
                $company->user()->update($userData);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            
            throw $e;
        }

        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $company->employees()->delete();
            $company->user()->delete();
            $company->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }

        return response()->json(null, 204);
    }
}
