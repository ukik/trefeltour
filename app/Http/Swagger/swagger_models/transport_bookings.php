<?php

/**
  * @OA\Get(
  *      path="/v1/entities/transport-bookings",
  *      operationId="browseTransportBooking",
  *      tags={"transport-bookings"},
  *      summary="Browse Transport Booking",
  *      description="Returns list of Transport Booking",
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
  *      path="/v1/entities/transport-bookings/read?slug=transport-bookings&id={id}",
  *      operationId="readTransportBooking",
  *      tags={"transport-bookings"},
  *      summary="Get Transport Booking based on id",
  *      description="Returns Transport Booking based on id",
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
  *      path="/v1/entities/transport-bookings/add",
  *      operationId="addTransportBooking",
  *      tags={"transport-bookings"},
  *      summary="Insert new Transport Booking",
  *      description="Insert new Transport Booking into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"daysDuration":"123", "dateRent":"Abc", "timeDepart":"Abc", "timeArrive":"2021-01-01T00:00:00.000Z", "destination":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "getDriverDailyPrice":"123", "description":"Abc"},
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
  *      path="/v1/entities/transport-bookings/edit",
  *      operationId="editTransportBooking",
  *      tags={"transport-bookings"},
  *      summary="Edit an existing Transport Booking",
  *      description="Edit an existing Transport Booking",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"daysDuration":"123", "dateRent":"Abc", "timeDepart":"Abc", "timeArrive":"2021-01-01T00:00:00.000Z", "destination":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "getDriverDailyPrice":"123", "description":"Abc"},
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
  *      path="/v1/entities/transport-bookings/delete",
  *      operationId="deleteTransportBooking",
  *      tags={"transport-bookings"},
  *      summary="Delete one record of Transport Booking",
  *      description="Delete one record of Transport Booking",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-bookings",
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
  *      path="/v1/entities/transport-bookings/delete-multiple",
  *      operationId="deleteMultipleTransportBooking",
  *      tags={"transport-bookings"},
  *      summary="Delete multiple record of Transport Booking",
  *      description="Delete multiple record of Transport Booking",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-bookings",
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
  *      path="/v1/entities/transport-bookings/sort",
  *      operationId="sortTransportBooking",
  *      tags={"transport-bookings"},
  *      summary="Sort existing Transport Booking",
  *      description="Sort existing Transport Booking",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-bookings",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "customerId":"", "driverId":"", "vehicleId":"", "uuid":"Abc", "daysDuration":"123", "dateRent":"Abc", "timeDepart":"Abc", "timeArrive":"2021-01-01T00:00:00.000Z", "destination":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "getDriverDailyPrice":"123", "getTotalAmountDriver":"123", "description":"Abc", "deletedAt":"2021-01-01T00:00:00.000Z", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "customerId":"", "driverId":"", "vehicleId":"", "uuid":"Abc", "daysDuration":"123", "dateRent":"Abc", "timeDepart":"Abc", "timeArrive":"2021-01-01T00:00:00.000Z", "destination":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "getDriverDailyPrice":"123", "getTotalAmountDriver":"123", "description":"Abc", "deletedAt":"2021-01-01T00:00:00.000Z", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="driverId"), 
  *                         @OA\Property(type="string", property="vehicleId"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="integer", property="daysDuration"), 
  *                         @OA\Property(type="string", property="dateRent"), 
  *                         @OA\Property(type="string", property="timeDepart"), 
  *                         @OA\Property(type="string", property="timeArrive"), 
  *                         @OA\Property(type="string", property="destination"), 
  *                         @OA\Property(type="integer", property="getPrice"), 
  *                         @OA\Property(type="integer", property="getDiscount"), 
  *                         @OA\Property(type="integer", property="getCashback"), 
  *                         @OA\Property(type="integer", property="getTotalAmount"), 
  *                         @OA\Property(type="integer", property="getDriverDailyPrice"), 
  *                         @OA\Property(type="integer", property="getTotalAmountDriver"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="deletedAt"), 
  *                         @OA\Property(type="string", property="codeTable"), 
  *                         @OA\Property(type="string", property="createdAt"), 
  *                         @OA\Property(type="string", property="updatedAt"),
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