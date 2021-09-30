<?php
namespace App\Api\Controllers\Reminder;

use App\Api\Controllers\Controller;
use App\Api\Controllers\Reminder\Resources\ReminderResource;
use App\Api\ServiceImplementation\ReminderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Reminder App",
 *      description="Reminder App Backend API doc",
 * )
 */

/**
 *
 * Reminder Controller contains all the methods
 *
 * Class ReminderController
 * @package App\Api\Controllers\Reminders
 */
class ReminderController extends BaseController
{
    /**
     * @var $reminderService
     */
    public $reminderService;

    /**
     * @param ReminderService $reminderService
     */
    public function __construct(ReminderServiceInterface $reminderServiceInterface, Request $request)
    {
        $this->reminderService = $reminderServiceInterface;
    }

    /**
     *
     * @OA\Post(
     *   path="/api/reminder/add",
     *   summary="Method to create a new reminder",
     *   tags={"Reminders"},
     *     description="Create new reminder",
     *     @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *              @OA\Property(
     *                   property="description",
     *                   type="string",
     *                   description="description of the reminder",
     *                   example = "Reminder to call client"
     *                 ),
     *               @OA\Property(
     *                   property="reminder_date",
     *                   type="date",
     *                   description="Date on which the reminder needs to be set",
     *                   example = "08-12-2021"
     *                 )
     *               ),
     *           )
     *       ),
     *
     *     @OA\Response(
     *              response=200,
     *              description="description & date"
     *     ),
     *     @OA\Response(
     *          response="default",
     *          description="Error message with details."
     *     ),
     *     @OA\Response(
     *          response=509,
     *          description="Unexpected response"
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Access forbidden"
     *     ),
     *     @OA\Response(
     *          response=515,
     *          description="Handled server error"
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Application issue, Please contact API maintenance Team."
     *     )
     * )
     */

    /**
     * Method to create new Reminder
     *
     * @param Request $request
     * @return Response
     */
    public function addReminder(Request $request)
    {
        $aRules = array(
            'description' => 'required|string',
            'reminder_date' => 'date|required|date_format:d-m-Y',
        );
        $validator = Validator::make($request->all(), $aRules, []);
        if ($validator->fails()) {
            return "false"; //@TODO add proper error messages
        }
        $response = $this->reminderService->addReminder($request->toArray());
        return ReminderResource::make($response);
    }

    /**
     * @OA\Put(
     ** path="/api/reminder/update/{id}",
     *   tags={"Reminders"},
     *   summary="Api for Update Reminder and mark as complete or open",
     *   operationId="reminder",
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="reminder_date",
     *      in="query",
     *      example="12-08-2021",
     *      required=false,
     *      @OA\Schema(
     *           type="date"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="status",
     *      in="query",
     *      description="send 1 to mark as Opened and 2 to mark as completed or 3 to mark as reopened",
     *      required=false,
     *      @OA\Schema(
     *           type="int"
     *      )
     *   ),
     *
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *     ),
     *     @OA\Response(
     *          response="default",
     *          description="Error message with details."
     *     ),
     *     @OA\Response(
     *          response=509,
     *          description="Unexpected response"
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Access forbidden"
     *     ),
     *     @OA\Response(
     *          response=515,
     *          description="Handled server error"
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Application issue, Please contact API maintenance Team."
     *     )
     *)
     **/

    /**
     * Updates the reminder description , date or status .
     *
     * @param Request $request
     * @return Response
     */
    public function updateReminder(int $id, Request $request)
    {
        $aRules = array(
            'description' => 'string',
            'reminder_date' => 'date|date_format:d-m-Y',
            'status' => 'int|in:1,2,3',
        );
        $validator = Validator::make($request->all(), $aRules, []);
        if ($validator->fails()) {
            return "false"; //@TODO add proper error messages
        }
        $this->reminderService->updateReminder($id, $request->toArray());
        return ['status' => 200, 'message' => trans('custom.success')];
    }

    /**
     * @OA\Get(
     ** path="/api/reminder/get",
     *   tags={"Reminders"},
     *   summary="Get reminders",
     *   operationId="getreminder",
     *
     *   @OA\Parameter(
     *      name="reminder_date",
     *      in="query",
     *      example="12-08-2021",
     *      required=false,
     *      @OA\Schema(
     *           type="date"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="status",
     *      in="query",
     *      description="Send blank to get all reminders , send 0 to get pending reminder , 1 to get Opened reminders , 2 to get completed reminders or 3 to get reopened reminders",
     *      required=false,
     *      @OA\Schema(
     *           type="int"
     *      )
     *   ),
     *
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *     ),
     *     @OA\Response(
     *          response="default",
     *          description="Error message with details."
     *     ),
     *     @OA\Response(
     *          response=509,
     *          description="Unexpected response"
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Access forbidden"
     *     ),
     *     @OA\Response(
     *          response=515,
     *          description="Handled server error"
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Application issue, Please contact API maintenance Team."
     *     )
     *)
     **/

    /**
     * Method to get list of reminders with filters
     *
     * @param Request $request
     * @return Response
     */
    public function getReminders(Request $request)
    {
        $aRules = array(
            'reminder_date' => 'date|date_format:d-m-Y',
            'status' => 'int|in:0,1,2,3',
        );
        $validator = Validator::make($request->all(), $aRules, []);
        if ($validator->fails()) {
            return "false"; //@TODO add proper error messages
        }
        $response = $this->reminderService->getReminders($request->toArray());
        return ReminderResource::collection($response);
    }

    /**
     * @OA\Delete(
     ** path="/api/reminder/delete",
     *   tags={"Reminders"},
     *   summary="Delete reminders",
     *   operationId="deletereminder",
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="int"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="reminder_date",
     *      in="query",
     *      example="12-08-2021",
     *      required=false,
     *      @OA\Schema(
     *           type="date"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="status",
     *      in="query",
     *      description=" send 2 to delete completed status reminders ",
     *      required=false,
     *      @OA\Schema(
     *           type="int"
     *      )
     *   ),
     *
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *     ),
     *     @OA\Response(
     *          response="default",
     *          description="Error message with details."
     *     ),
     *     @OA\Response(
     *          response=509,
     *          description="Unexpected response"
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Access forbidden"
     *     ),
     *     @OA\Response(
     *          response=515,
     *          description="Handled server error"
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Application issue, Please contact API maintenance Team."
     *     )
     *)
     **/

    /**
     * Deletes the reminder
     *
     * @param Request $request
     * @return ReminderResource
     */
    public function deleteReminders(Request $request)
    {
        $aRules = array(
            'id' => 'int',
            'reminder_date' => 'date|date_format:d-m-Y',
            'status' => 'int|in:2',
        );
        $validator = Validator::make($request->all(), $aRules, []);
        if ($validator->fails()) {
            return "false"; //@TODO add proper error messages
        }
        $response = $this->reminderService->deleteReminders($request->toArray());
        return ['status' => 200, 'message' => trans('custom.success'), 'data' => $response];
    }
}
