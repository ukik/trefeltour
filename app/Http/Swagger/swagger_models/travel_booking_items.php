<?php

/**
  * @OA\Get(
  *      path="/v1/entities/travel-booking-items",
  *      operationId="browseTravelBookingItems",
  *      tags={"travel-booking-items"},
  *      summary="Browse Travel Booking Items",
  *      description="Returns list of Travel Booking Items",
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
  *      path="/v1/entities/travel-booking-items/read?slug=travel-booking-items&id={id}",
  *      operationId="readTravelBookingItems",
  *      tags={"travel-booking-items"},
  *      summary="Get Travel Booking Items based on id",
  *      description="Returns Travel Booking Items based on id",
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
  *      path="/v1/entities/travel-booking-items/add",
  *      operationId="addTravelBookingItems",
  *      tags={"travel-booking-items"},
  *      summary="Insert new Travel Booking Items",
  *      description="Insert new Travel Booking Items into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={},
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
  *      path="/v1/entities/travel-booking-items/edit",
  *      operationId="editTravelBookingItems",
  *      tags={"travel-booking-items"},
  *      summary="Edit an existing Travel Booking Items",
  *      description="Edit an existing Travel Booking Items",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={},
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
  *      path="/v1/entities/travel-booking-items/delete",
  *      operationId="deleteTravelBookingItems",
  *      tags={"travel-booking-items"},
  *      summary="Delete one record of Travel Booking Items",
  *      description="Delete one record of Travel Booking Items",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-booking-items",
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
  *      path="/v1/entities/travel-booking-items/delete-multiple",
  *      operationId="deleteMultipleTravelBookingItems",
  *      tags={"travel-booking-items"},
  *      summary="Delete multiple record of Travel Booking Items",
  *      description="Delete multiple record of Travel Booking Items",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-booking-items",
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
  *      path="/v1/entities/travel-booking-items/sort",
  *      operationId="sortTravelBookingItems",
  *      tags={"travel-booking-items"},
  *      summary="Sort existing Travel Booking Items",
  *      description="Sort existing Travel Booking Items",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-booking-items",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "reservationId":"", "customerId":"", "bookingId":"", "storeId":"", "name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "getFinalAmount":"123", "description":"Abc", "codeTicket":"Abc", "seatNo":"Abc", "ticketStatus":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc", "quantity":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "reservationId":"", "customerId":"", "bookingId":"", "storeId":"", "name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "getFinalAmount":"123", "description":"Abc", "codeTicket":"Abc", "seatNo":"Abc", "ticketStatus":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc", "quantity":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="reservationId"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="bookingId"), 
  *                         @OA\Property(type="string", property="storeId"), 
  *                         @OA\Property(type="string", property="name"), 
  *                         @OA\Property(type="integer", property="getPrice"), 
  *                         @OA\Property(type="integer", property="getDiscount"), 
  *                         @OA\Property(type="integer", property="getCashback"), 
  *                         @OA\Property(type="integer", property="getTotalAmount"), 
  *                         @OA\Property(type="integer", property="getFinalAmount"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="codeTicket"), 
  *                         @OA\Property(type="string", property="seatNo"), 
  *                         @OA\Property(type="string", property="ticketStatus"), 
  *                         @OA\Property(type="string", property="startingDate"), 
  *                         @OA\Property(type="string", property="startingTime"), 
  *                         @OA\Property(type="string", property="startingLocation"), 
  *                         @OA\Property(type="string", property="arrivalLocation"), 
  *                         @OA\Property(type="string", property="startingTerminal"), 
  *                         @OA\Property(type="string", property="arrivalTerminal"), 
  *                         @OA\Property(type="string", property="quantity"), 
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