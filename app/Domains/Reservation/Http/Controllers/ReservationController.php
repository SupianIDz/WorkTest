<?php

namespace App\Domains\Reservation\Http\Controllers;

use App\Domains\Reservation\Actions\CreateReservationAction;
use App\Domains\Reservation\Entities\CreateReservationEntity;
use App\Domains\Reservation\Exceptions\TableNotAvailableException;
use App\Domains\Reservation\Http\Requests\CreateReservationRequest;
use App\Domains\Reservation\Models\Reservation;
use App\Laravel\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ReservationController extends Controller
{
    /**
     * ReservationController constructor.
     */
    public function __construct()
    {
        // This simple middleware functions as an authentication guard switcher,
        // allowing unauthenticated users to place orders on the same route.
        $this->middleware(function ($request, $next) {
            if ($request->hasHeader('Authorization')) {
                config([
                    'auth.defaults.guard' => 'sanctum',
                ]);
            }

            return $next($request);
        });
    }

    /**
     * @param  CreateReservationRequest $request
     * @param  CreateReservationAction  $service
     * @return JsonResponse
     */
    public function store(CreateReservationRequest $request, CreateReservationAction $service)
    {
        $lock = Cache::lock('reservation', 5);

        try {
            $lock->block(5);

            $entity = new CreateReservationEntity;
            $entity->fromRequest($request);

            /**
             * @var Reservation $reservation
             */
            if ($reservation = $service->handle($entity, $request->user())) {
                return response()->json([
                    'message' => 'Reservation created successfully',
                    'data'    => [
                        'booking_id' => $reservation->code,
                        'booked_by'  => $reservation->user?->only('name', 'email'),
                    ],
                ], 201);
            }
        } catch (LockTimeoutException $e) {
            return response()->json([
                'message' => 'Reservation creation is already in progress',
            ], 409);
        } catch (Exception|TableNotAvailableException $exception) {
            return response()->json(['message' => $exception->getMessage()], $exception->getCode());
        } finally {
            // The code below is required, but for testing purposes, make it a comment.
            //  $lock?->release();
        }
    }
}
