<?php

/**
  * @OA\Get(
  *      path="/v1/entities/travel-prices",
  *      operationId="browseTravelHargaTiket",
  *      tags={"travel-prices"},
  *      summary="Browse Travel Harga Tiket",
  *      description="Returns list of Travel Harga Tiket",
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
  *      path="/v1/entities/travel-prices/read?slug=travel-prices&id={id}",
  *      operationId="readTravelHargaTiket",
  *      tags={"travel-prices"},
  *      summary="Get Travel Harga Tiket based on id",
  *      description="Returns Travel Harga Tiket based on id",
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
  *      path="/v1/entities/travel-prices/add",
  *      operationId="addTravelHargaTiket",
  *      tags={"travel-prices"},
  *      summary="Insert new Travel Harga Tiket",
  *      description="Insert new Travel Harga Tiket into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "generalPrice":"123", "discountPrice":"123", "cashbackPrice":"123", "description":"Abc", "codeTicket":"Abc", "seatNo":"Abc", "image":"Abc", "ticketStatus":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc"},
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
  *      path="/v1/entities/travel-prices/edit",
  *      operationId="editTravelHargaTiket",
  *      tags={"travel-prices"},
  *      summary="Edit an existing Travel Harga Tiket",
  *      description="Edit an existing Travel Harga Tiket",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "generalPrice":"123", "discountPrice":"123", "cashbackPrice":"123", "description":"Abc", "codeTicket":"Abc", "seatNo":"Abc", "image":"Abc", "ticketStatus":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc"},
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
  *      path="/v1/entities/travel-prices/delete",
  *      operationId="deleteTravelHargaTiket",
  *      tags={"travel-prices"},
  *      summary="Delete one record of Travel Harga Tiket",
  *      description="Delete one record of Travel Harga Tiket",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-prices",
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
  *      path="/v1/entities/travel-prices/delete-multiple",
  *      operationId="deleteMultipleTravelHargaTiket",
  *      tags={"travel-prices"},
  *      summary="Delete multiple record of Travel Harga Tiket",
  *      description="Delete multiple record of Travel Harga Tiket",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-prices",
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
  *      path="/v1/entities/travel-prices/sort",
  *      operationId="sortTravelHargaTiket",
  *      tags={"travel-prices"},
  *      summary="Sort existing Travel Harga Tiket",
  *      description="Sort existing Travel Harga Tiket",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-prices",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "reservationId":"", "customerId":"", "storeId":"", "name":"Abc", "generalPrice":"123", "discountPrice":"123", "cashbackPrice":"123", "description":"Abc", "codeTicket":"Abc", "seatNo":"Abc", "image":"Abc", "ticketStatus":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc", "quantity":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "reservationId":"", "customerId":"", "storeId":"", "name":"Abc", "generalPrice":"123", "discountPrice":"123", "cashbackPrice":"123", "description":"Abc", "codeTicket":"Abc", "seatNo":"Abc", "image":"Abc", "ticketStatus":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc", "quantity":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="reservationId"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="storeId"), 
  *                         @OA\Property(type="string", property="name"), 
  *                         @OA\Property(type="integer", property="generalPrice"), 
  *                         @OA\Property(type="integer", property="discountPrice"), 
  *                         @OA\Property(type="integer", property="cashbackPrice"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="codeTicket"), 
  *                         @OA\Property(type="string", property="seatNo"), 
  *                         @OA\Property(type="string", property="image"), 
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