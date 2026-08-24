<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AiDraftRequest;
use App\Services\GeminiAiService;
use Exception;
use Illuminate\Http\JsonResponse;

class AiAssistantController extends Controller
{
    /**
     * Generate structured draft or text improvement.
     */
    public function generate(AiDraftRequest $request, GeminiAiService $aiService): JsonResponse
    {
        try {
            $validated = $request->validated();

            $feature = $validated['feature'];
            $mode = $validated['mode'];
            $notes = $validated['notes'] ?? null;
            $existingText = $validated['existing_text'] ?? null;

            $result = $aiService->generate($feature, $mode, $notes, $existingText);

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Layanan bantuan AI sedang tidak tersedia. Silakan lanjutkan pengisian secara manual.',
            ], 422);
        }
    }
}
