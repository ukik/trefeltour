<?php

/**
  * @OA\Get(
  *      path="/v1/entities/souvenir-booking-items",
  *      operationId="browseSuvenirBookingItem",
  *      tags={"souvenir-booking-items"},
  *      summary="Browse Suvenir Booking Item",
  *      description="Returns list of Suvenir Booking Item",
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
  *      path="/v1/entities/souvenir-booking-items/read?slug=souvenir-booking-items&id={id}",
  *      operationId="readSuvenirBookingItem",
  *      tags={"souvenir-booking-items"},
  *      summary="Get Suvenir Booking Item based on id",
  *      description="Returns Suvenir Booking Item based on id",
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
  *      path="/v1/entities/souvenir-booking-items/add",
  *      operationId="addSuvenirBookingItem",
  *      tags={"souvenir-booking-items"},
  *      summary="Insert new Suvenir Booking Item",
  *      description="Insert new Suvenir Booking Item into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "getPrice":"123"},
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
  *      path="/v1/entities/souvenir-booking-items/edit",
  *      operationId="editSuvenirBookingItem",
  *      tags={"souvenir-booking-items"},
  *      summary="Edit an existing Suvenir Booking Item",
  *      description="Edit an existing Suvenir Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "getPrice":"123"},
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
  *      path="/v1/entities/souvenir-booking-items/delete",
  *      operationId="deleteSuvenirBookingItem",
  *      tags={"souvenir-booking-items"},
  *      summary="Delete one record of Suvenir Booking Item",
  *      description="Delete one record of Suvenir Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="souvenir-booking-items",
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
  *      path="/v1/entities/souvenir-booking-items/delete-multiple",
  *      operationId="deleteMultipleSuvenirBookingItem",
  *      tags={"souvenir-booking-items"},
  *      summary="Delete multiple record of Suvenir Booking Item",
  *      description="Delete multiple record of Suvenir Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="souvenir-booking-items",
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
  *      path="/v1/entities/souvenir-booking-items/sort",
  *      operationId="sortSuvenirBookingItem",
  *      tags={"souvenir-booking-items"},
  *      summary="Sort existing Suvenir Booking Item",
  *      description="Sort existing Suvenir Booking Item",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="souvenir-booking-items",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "bookingId":"", "customerId":"", "storeId":"", "productId":"", "name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "quantity":"123", "getFinalAmount":"123", "description":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "bookingId":"", "customerId":"", "storeId":"", "productId":"", "name":"Abc", "getPrice":"123", "getDiscount":"123", "getCashback":"123", "getTotalAmount":"123", "quantity":"123", "getFinalAmount":"123", "description":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="bookingId"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="storeId"), 
  *                         @OA\Property(type="string", property="productId"), 
  *                         @OA\Property(type="string", property="name"), 
  *                         @OA\Property(type="integer", property="getPrice"), 
  *                         @OA\Property(type="integer", property="getDiscount"), 
  *                         @OA\Property(type="integer", property="getCashback"), 
  *                         @OA\Property(type="integer", property="getTotalAmount"), 
  *                         @OA\Property(type="integer", property="quantity"), 
  *                         @OA\Property(type="integer", property="getFinalAmount"), 
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