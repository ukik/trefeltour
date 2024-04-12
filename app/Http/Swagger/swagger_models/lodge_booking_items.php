<?php

/**
  * @OA\Get(
  *      path="/v1/entities/lodge-booking-items",
  *      operationId="browseHotelBookingItem",
  *      tags={"lodge-booking-items"},
  *      summary="Browse Hotel Booking Item",
  *      description="Returns list of Hotel Booking Item",
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
  *      path="/v1/entities/lodge-booking-items/read?slug=lodge-booking-items&id={id}",
  *      operationId="readHotelBookingItem",
  *      tags={"lodge-booking-items"},
  *      summary="Get Hotel Booking Item based on id",
  *      description="Returns Hotel Booking Item based on id",
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
  *      path="/v1/entities/lodge-booking-items/add",
  *      operationId="addHotelBookingItem",
  *      tags={"lodge-booking-items"},
  *      summary="Insert new Hotel Booking Item",
  *      description="Insert new Hotel Booking Item into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "quantity":"123", "getFinalAmount":"123", "description":"Abc"},
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
  *      path="/v1/entities/lodge-booking-items/edit",
  *      operationId="editHotelBookingItem",
  *      tags={"lodge-booking-items"},
  *      summary="Edit an existing Hotel Booking Item",
  *      description="Edit an existing Hotel Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "quantity":"123", "getFinalAmount":"123", "description":"Abc"},
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
  *      path="/v1/entities/lodge-booking-items/delete",
  *      operationId="deleteHotelBookingItem",
  *      tags={"lodge-booking-items"},
  *      summary="Delete one record of Hotel Booking Item",
  *      description="Delete one record of Hotel Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-booking-items",
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
  *      path="/v1/entities/lodge-booking-items/delete-multiple",
  *      operationId="deleteMultipleHotelBookingItem",
  *      tags={"lodge-booking-items"},
  *      summary="Delete multiple record of Hotel Booking Item",
  *      description="Delete multiple record of Hotel Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-booking-items",
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
  *      path="/v1/entities/lodge-booking-items/sort",
  *      operationId="sortHotelBookingItem",
  *      tags={"lodge-booking-items"},
  *      summary="Sort existing Hotel Booking Item",
  *      description="Sort existing Hotel Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-booking-items",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "bookingId":"", "customerId":"", "profileId":"", "roomId":"", "name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "quantity":"123", "getFinalAmount":"123", "dateCheckin":"Abc", "description":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "bookingId":"", "customerId":"", "profileId":"", "roomId":"", "name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "quantity":"123", "getFinalAmount":"123", "dateCheckin":"Abc", "description":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="bookingId"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="profileId"), 
  *                         @OA\Property(type="string", property="roomId"), 
  *                         @OA\Property(type="string", property="name"), 
  *                         @OA\Property(type="integer", property="getPrice"), 
  *                         @OA\Property(type="integer", property="getDiscount"), 
  *                         @OA\Property(type="integer", property="getCashback"), 
  *                         @OA\Property(type="integer", property="getTotalAmount"), 
  *                         @OA\Property(type="integer", property="quantity"), 
  *                         @OA\Property(type="integer", property="getFinalAmount"), 
  *                         @OA\Property(type="string", property="dateCheckin"), 
  *                         @OA\Property(type="string", property="description"), 
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