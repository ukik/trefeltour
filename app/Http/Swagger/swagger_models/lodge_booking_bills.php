<?php

/**
  * @OA\Get(
  *      path="/v1/entities/lodge-booking-bills",
  *      operationId="browseLodgeBookingBills",
  *      tags={"lodge-booking-bills"},
  *      summary="Browse Lodge Booking Bills",
  *      description="Returns list of Lodge Booking Bills",
  *      @OA\Response(response=200, description="Successful operation"),
  *      @OA\Response(response=400, description="Bad request"),
  *      @OA\Response(response=401, description="Unauthorized"),
  *      @OA\Response(response=402, description="Payment Required"),
  *      security={
  *          {"bearerAuth": {}}
  *      }
  * )
  *
  */

/**
  * @OA\Get(
  *      path="/v1/entities/lodge-booking-bills/read?slug=lodge-booking-bills&id={id}",
  *      operationId="readLodgeBookingBills",
  *      tags={"lodge-booking-bills"},
  *      summary="Get Lodge Booking Bills based on id",
  *      description="Returns Lodge Booking Bills based on id",
  *      @OA\Parameter(
  *          name="id",
  *          required=true,
  *          in="path",
  *          @OA\Schema(
  *              type="integer"
  *          )
  *      ),
  *      @OA\Response(response=200, description="Successful operation"),
  *      @OA\Response(response=400, description="Bad request"),
  *      @OA\Response(response=401, description="Unauthorized"),
  *      @OA\Response(response=402, description="Payment Required"),
  *      security={
  *          {"bearerAuth": {}}
  *      }
  * )
  *
  */

/**
  * @OA\Post(
  *      path="/v1/entities/lodge-booking-bills/add",
  *      operationId="addLodgeBookingBills",
  *      tags={"lodge-booking-bills"},
  *      summary="Insert new Lodge Booking Bills",
  *      description="Insert new Lodge Booking Bills into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"description":"Abc", "getPerNightPrice":"123", "getShuttleToAirportPrice":"123", "getAdditionalBreakfastPrice":"123", "getLateCheckoutPrice":"123", "getDiscountPrice":"123", "getBarChargePrice":"123", "getRestaurantChargePrice":"123", "getRoomServiceChargePrice":"123"},
  *                 ),
  *             )
  *         )
  *      ),
  *      @OA\Response(response=200, description="Successful operation"),
  *      @OA\Response(response=400, description="Bad request"),
  *      @OA\Response(response=401, description="Unauthorized"),
  *      @OA\Response(response=402, description="Payment Required"),
  *      security={
  *          {"bearerAuth": {}}
  *      }
  * )
  *
  */

/**
  * @OA\Put(
  *      path="/v1/entities/lodge-booking-bills/edit",
  *      operationId="editLodgeBookingBills",
  *      tags={"lodge-booking-bills"},
  *      summary="Edit an existing Lodge Booking Bills",
  *      description="Edit an existing Lodge Booking Bills",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"description":"Abc", "getPerNightPrice":"123", "getShuttleToAirportPrice":"123", "getAdditionalBreakfastPrice":"123", "getLateCheckoutPrice":"123", "getDiscountPrice":"123", "getBarChargePrice":"123", "getRestaurantChargePrice":"123", "getRoomServiceChargePrice":"123"},
  *                ),
  *             )
  *         )
  *     ),
  *      @OA\Response(response=200, description="Successful operation"),
  *      @OA\Response(response=400, description="Bad request"),
  *      @OA\Response(response=401, description="Unauthorized"),
  *      @OA\Response(response=402, description="Payment Required"),
  *      security={
  *          {"bearerAuth": {}}
  *      }
  * )
  *
  */

/**
  * @OA\Delete(
  *      path="/v1/entities/lodge-booking-bills/delete",
  *      operationId="deleteLodgeBookingBills",
  *      tags={"lodge-booking-bills"},
  *      summary="Delete one record of Lodge Booking Bills",
  *      description="Delete one record of Lodge Booking Bills",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-booking-bills",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="string", property="field", default="id"),
  *                         @OA\Property(type="integer", property="value", example="123"),
  *                     ),
  *                ),
  *             )
  *         )
  *     ),
  *      @OA\Response(response=200, description="Successful operation"),
  *      @OA\Response(response=400, description="Bad request"),
  *      @OA\Response(response=401, description="Unauthorized"),
  *      @OA\Response(response=402, description="Payment Required"),
  *      security={
  *          {"bearerAuth": {}}
  *      }
  * )
  *
  */

/**
  * @OA\Delete(
  *      path="/v1/entities/lodge-booking-bills/delete-multiple",
  *      operationId="deleteMultipleLodgeBookingBills",
  *      tags={"lodge-booking-bills"},
  *      summary="Delete multiple record of Lodge Booking Bills",
  *      description="Delete multiple record of Lodge Booking Bills",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-booking-bills",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="string", property="field", default="ids"),
  *                         @OA\Property(type="{}", property="value", example="123,123"),
  *                     ),
  *                ),
  *             )
  *         )
  *     ),
  *      @OA\Response(response=200, description="Successful operation"),
  *      @OA\Response(response=400, description="Bad request"),
  *      @OA\Response(response=401, description="Unauthorized"),
  *      @OA\Response(response=402, description="Payment Required"),
  *      security={
  *          {"bearerAuth": {}}
  *      }
  * )
  *
  */

/**
  * @OA\Put(
  *      path="/v1/entities/lodge-booking-bills/sort",
  *      operationId="sortLodgeBookingBills",
  *      tags={"lodge-booking-bills"},
  *      summary="Sort existing Lodge Booking Bills",
  *      description="Sort existing Lodge Booking Bills",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-booking-bills",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "customerId":"", "bookingId":"", "description":"Abc", "getPerNightPrice":"123", "getShuttleToAirportPrice":"123", "getAdditionalBreakfastPrice":"123", "getLateCheckoutPrice":"123", "getDiscountPrice":"123", "getBarChargePrice":"123", "getRestaurantChargePrice":"123", "getRoomServiceChargePrice":"123", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "customerId":"", "bookingId":"", "description":"Abc", "getPerNightPrice":"123", "getShuttleToAirportPrice":"123", "getAdditionalBreakfastPrice":"123", "getLateCheckoutPrice":"123", "getDiscountPrice":"123", "getBarChargePrice":"123", "getRestaurantChargePrice":"123", "getRoomServiceChargePrice":"123", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="bookingId"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="integer", property="getPerNightPrice"), 
  *                         @OA\Property(type="integer", property="getShuttleToAirportPrice"), 
  *                         @OA\Property(type="integer", property="getAdditionalBreakfastPrice"), 
  *                         @OA\Property(type="integer", property="getLateCheckoutPrice"), 
  *                         @OA\Property(type="integer", property="getDiscountPrice"), 
  *                         @OA\Property(type="integer", property="getBarChargePrice"), 
  *                         @OA\Property(type="integer", property="getRestaurantChargePrice"), 
  *                         @OA\Property(type="integer", property="getRoomServiceChargePrice"), 
  *                         @OA\Property(type="string", property="codeTable"), 
  *                         @OA\Property(type="string", property="createdAt"), 
  *                         @OA\Property(type="string", property="updatedAt"), 
  *                         @OA\Property(type="string", property="deletedAt"),
  *                     ),
  *                ),
  *             )
  *         )
  *     ),
  *      @OA\Response(response=200, description="Successful operation"),
  *      @OA\Response(response=400, description="Bad request"),
  *      @OA\Response(response=401, description="Unauthorized"),
  *      @OA\Response(response=402, description="Payment Required"),
  *      security={
  *          {"bearerAuth": {}}
  *      }
  * )
  *
  */