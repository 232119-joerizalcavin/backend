<?php

namespace App\Http\Controllers;

use App\Models\BarangKargo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BarangKargoController extends Controller
{
    /**
     * Display a listing of barang kargos
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 10);
            $barangKargos = BarangKargo::with('gerbong')->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'message' => 'Barang kargos retrieved successfully',
                'data' => $barangKargos->items(),
                'pagination' => [
                    'current_page' => $barangKargos->currentPage(),
                    'per_page' => $barangKargos->perPage(),
                    'total' => $barangKargos->total(),
                    'last_page' => $barangKargos->lastPage(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve barang kargos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created barang kargo
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'gerbong_id' => 'required|exists:gerbongs,id',
                'nama_barang' => 'required|string|max:255',
                'nama_klien' => 'required|string|max:255',
                'berat_muatan' => 'required|integer|min:0',
                'status' => 'required|string|max:100',
            ]);

            $barangKargo = BarangKargo::create($validated);
            $barangKargo->load('gerbong');

            return response()->json([
                'message' => 'Barang kargo created successfully',
                'data' => $barangKargo
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create barang kargo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified barang kargo
     */
    public function show(BarangKargo $barangKargo)
    {
        try {
            $barangKargo->load('gerbong');
            return response()->json([
                'message' => 'Barang kargo retrieved successfully',
                'data' => $barangKargo
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Barang kargo not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified barang kargo
     */
    public function update(Request $request, BarangKargo $barangKargo)
    {
        try {
            $validated = $request->validate([
                'gerbong_id' => 'required|exists:gerbongs,id',
                'nama_barang' => 'required|string|max:255',
                'nama_klien' => 'required|string|max:255',
                'berat_muatan' => 'required|integer|min:0',
                'status' => 'required|string|max:100',
            ]);

            $barangKargo->update($validated);
            $barangKargo->load('gerbong');

            return response()->json([
                'message' => 'Barang kargo updated successfully',
                'data' => $barangKargo
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update barang kargo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified barang kargo
     */
    public function destroy(BarangKargo $barangKargo)
    {
        try {
            $barangKargo->delete();

            return response()->json([
                'message' => 'Barang kargo deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete barang kargo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cargo by gerbong
     */
    public function byGerbong(Request $request, $gerbongId)
    {
        try {
            $barangKargos = BarangKargo::where('gerbong_id', $gerbongId)
                ->with('gerbong')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Cargo retrieved successfully',
                'data' => $barangKargos
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve cargo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cargo by status
     */
    public function byStatus(Request $request, $status)
    {
        try {
            $barangKargos = BarangKargo::where('status', $status)
                ->with('gerbong')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'message' => 'Cargo retrieved successfully',
                'data' => $barangKargos
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve cargo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
