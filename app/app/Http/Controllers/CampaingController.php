<?php

namespace App\Http\Controllers;

use App\Models\Campaing;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(Campaing::all(), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            return response()->json(Campaing::create($request->all()), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaing $campaing)
    {
        try {
            return response()->json($campaing, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaing $campaing)
    {
        try {
            $campaing->update($request->all());

            return response()->json($campaing, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaing $campaing)
    {
        try {
            $campaing->delete();

            return response()->json(null, Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all campaings by player.
     */
    public function allByPlayer($player): JsonResponse
    {
        try {
            return response()->json(
                Campaing::join('player_campaings', 'player_campaings.campaing_uuid', '=', 'campaings.uuid')
                    ->where('player_campaings.player_uuid', $player)
                    ->get(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all campaings by owner.
     */
    public function allFromOwner($player): JsonResponse
    {
        try {
            return response()->json(Campaing::where('owner_id', $player)->get(), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all requests from player.
     */
    public function allRequests($player): JsonResponse
    {
        try {
            return response()->json(
                Campaing::select('campaings.*', 'request_status')
                    ->join('player_campaings', 'player_campaings.campaing_uuid', '=', 'campaings.uuid')
                    ->where('player_campaings.player_uuid', $player)
                    ->where('player_campaings.request_status', 'pending')
                    ->get(),
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Accept a request from player.
     */
    public function acceptRequest(Request $request): JsonResponse
    {
        try {
            $player = $request->input('player');
            $campaing = $request->input('campaing');

            Campaing::join('player_campaings', 'player_campaings.campaing_uuid', '=', 'campaings.uuid')
                ->where('player_campaings.player_uuid', $player)
                ->where('player_campaings.campaing_uuid', $campaing)
                ->update(['player_campaings.status' => 'accepted']);

            return response()->json(null, Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Refuse a request from player.
     */
    public function refuseRequest(Request $request): JsonResponse
    {
        try {
            $player = $request->input('player');
            $campaing = $request->input('campaing');

            Campaing::join('player_campaings', 'player_campaings.campaing_uuid', '=', 'campaings.uuid')
                ->where('player_campaings.player_uuid', $player)
                ->where('player_campaings.campaing_uuid', $campaing)
                ->update(['player_campaings.status' => 'refused']);

            return response()->json(null, Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
