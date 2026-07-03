<?php

namespace App\Http\Controllers;

use App\Models\Gerbong;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GerbongController extends Controller
{
    /**
     * Display a listing of gerbongs
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 10);
            $gerbongs = Gerbong::with('barangKargos')->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'message' => 'Gerbongs retrieved successfully',
                'data' => $gerbongs->items(),
                'pagination' => [
                    'current_page' => $gerbongs->currentPage(),
                    'per_page' => $gerbongs->perPage(),
                    'total' => $gerbongs->total(),
                    'last_page' => $gerbongs->lastPage(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve gerbongs',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created gerbong
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_gerbong' => 'required|string|max:50|unique:gerbongs',
                'jenis_gerbong' => 'required|string|max:255',
                'kapasitas_maks' => 'required|integer|min:1',
                'nomor_seri' => 'nullable|string|max:100',
                'lokasi' => 'nullable|string|max:255',
                'tanggal_pembuatan' => 'nullable|date',
                'status' => 'nullable|in:Aktif,Maintenance,Pensiun',
                'kondisi' => 'nullable|in:Baik,Perlu Perbaikan,Rusak',
            ]);

            $gerbong = Gerbong::create($validated);

            return response()->json([
                'message' => 'Gerbong created successfully',
                'data' => $gerbong
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create gerbong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified gerbong
     */
    public function show(Gerbong $gerbong)
    {
        try {
            $gerbong->load('barangKargos');
            return response()->json([
                'message' => 'Gerbong retrieved successfully',
                'data' => $gerbong
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gerbong not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified gerbong
     */
    public function update(Request $request, Gerbong $gerbong)
    {
        try {
            $validated = $request->validate([
                'kode_gerbong' => 'required|string|max:50|unique:gerbongs,kode_gerbong,' . $gerbong->id,
                'jenis_gerbong' => 'required|string|max:255',
                'kapasitas_maks' => 'required|integer|min:1',
                'nomor_seri' => 'nullable|string|max:100',
                'lokasi' => 'nullable|string|max:255',
                'tanggal_pembuatan' => 'nullable|date',
                'status' => 'nullable|in:Aktif,Maintenance,Pensiun',
                'kondisi' => 'nullable|in:Baik,Perlu Perbaikan,Rusak',
            ]);

            $gerbong->update($validated);

            return response()->json([
                'message' => 'Gerbong updated successfully',
                'data' => $gerbong
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update gerbong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified gerbong
     */
    public function destroy(Gerbong $gerbong)
    {
        try {
            $gerbong->delete();

            return response()->json([
                'message' => 'Gerbong deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete gerbong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get gerbongs with cargo
     */
    public function withCargo()
    {
        try {
            $gerbongs = Gerbong::with('barangKargos')
                ->has('barangKargos')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Gerbongs with cargo retrieved successfully',
                'data' => $gerbongs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve gerbongs',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get empty gerbongs
     */
    public function empty()
    {
        try {
            $gerbongs = Gerbong::doesntHave('barangKargos')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Empty gerbongs retrieved successfully',
                'data' => $gerbongs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve empty gerbongs',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
