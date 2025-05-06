<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PaymentProof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PaymentProofController extends Controller
{
    /**
     * Store a newly created payment proof in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'file' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
                'notes' => 'nullable|string|max:1000',
                'period' => 'required|string|regex:/^\d{4}-\d{2}$/' // Format: YYYY-MM
            ]);

            $file = $request->file('file');
            
            if (!$file->isValid()) {
                return response()->json([
                    'message' => 'Invalid file upload'
                ], 422);
            }

            $fileType = $file->getClientMimeType() === 'application/pdf' ? 'pdf' : 'image';
            
            // Create payment_proofs directory if it doesn't exist
            $storagePath = Storage::disk('public')->path('payment_proofs');
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }
            
            // Store file with original name
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('payment_proofs', $fileName, 'public');

            if (!$path) {
                return response()->json([
                    'message' => 'Failed to store file'
                ], 500);
            }

            $paymentProof = PaymentProof::create([
                'user_id' => $validated['user_id'],
                'file_path' => $path,
                'file_type' => $fileType,
                'notes' => $validated['notes'],
                'period' => $validated['period']
            ]);

            return response()->json([
                'message' => 'Payment proof uploaded successfully',
                'payment_proof' => [
                    'id' => $paymentProof->id,
                    'file_url' => asset('storage/' . $path),
                    'file_type' => $fileType,
                    'notes' => $validated['notes'],
                    'created_at' => $paymentProof->created_at->format('Y-m-d H:i:s')
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Payment proof upload failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to upload payment proof: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified payment proof.
     */
    public function show(PaymentProof $paymentProof)
    {
        try {
            return response()->json([
                'payment_proof' => [
                    'id' => $paymentProof->id,
                    'file_url' => $paymentProof->file_url,
                    'file_type' => $paymentProof->file_type,
                    'notes' => $paymentProof->notes,
                    'period' => $paymentProof->formatted_period,
                    'created_at' => $paymentProof->created_at->format('Y-m-d H:i:s')
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve payment proof: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve payment proof'
            ], 500);
        }
    }

    /**
     * Remove the specified payment proof from storage.
     */
    public function destroy(PaymentProof $paymentProof)
    {
        try {
            // Delete the file from storage
            if (Storage::disk('public')->exists($paymentProof->file_path)) {
                Storage::disk('public')->delete($paymentProof->file_path);
            }
            
            // Delete the record from database
            $paymentProof->delete();

            return response()->json([
                'message' => 'Payment proof deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to delete payment proof: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to delete payment proof'
            ], 500);
        }
    }

    /**
     * Get payment proofs for a specific user and period.
     */
    public function getUserProofs(User $user, $period)
    {
        try {
            $proofs = $user->paymentProofs()
                ->where('period', $period)
                ->latest()
                ->get()
                ->map(function ($proof) {
                    return [
                        'id' => $proof->id,
                        'file_url' => $proof->file_url,
                        'file_type' => $proof->file_type,
                        'notes' => $proof->notes,
                        'created_at' => $proof->created_at->format('Y-m-d H:i:s')
                    ];
                });

            return response()->json([
                'payment_proofs' => $proofs
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve user payment proofs: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to retrieve payment proofs'
            ], 500);
        }
    }
}
