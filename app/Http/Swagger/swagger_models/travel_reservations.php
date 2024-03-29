<?php

/**
  * @OA\Get(
  *      path="/v1/entities/travel-reservations",
  *      operationId="browseTravelReservations",
  *      tags={"travel-reservations"},
  *      summary="Browse Travel Reservations",
  *      description="Returns list of Travel Reservations",
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
  *      path="/v1/entities/travel-reservations/read?slug=travel-reservations&id={id}",
  *      operationId="readTravelReservations",
  *      tags={"travel-reservations"},
  *      summary="Get Travel Reservations based on id",
  *      description="Returns Travel Reservations based on id",
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
  *      path="/v1/entities/travel-reservations/add",
  *      operationId="addTravelReservations",
  *      tags={"travel-reservations"},
  *      summary="Insert new Travel Reservations",
  *      description="Insert new Travel Reservations into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"namePassanger":"Abc", "ktpPassanger":"123", "birthDate":"Abc", "category":"Abc", "minBudget":"123", "maxBudget":"123", "ticketStatus":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc"},
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
  *      path="/v1/entities/travel-reservations/edit",
  *      operationId="editTravelReservations",
  *      tags={"travel-reservations"},
  *      summary="Edit an existing Travel Reservations",
  *      description="Edit an existing Travel Reservations",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"namePassanger":"Abc", "ktpPassanger":"123", "birthDate":"Abc", "category":"Abc", "minBudget":"123", "maxBudget":"123", "ticketStatus":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc"},
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
  *      path="/v1/entities/travel-reservations/delete",
  *      operationId="deleteTravelReservations",
  *      tags={"travel-reservations"},
  *      summary="Delete one record of Travel Reservations",
  *      description="Delete one record of Travel Reservations",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-reservations",
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
  *      path="/v1/entities/travel-reservations/delete-multiple",
  *      operationId="deleteMultipleTravelReservations",
  *      tags={"travel-reservations"},
  *      summary="Delete multiple record of Travel Reservations",
  *      description="Delete multiple record of Travel Reservations",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-reservations",
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
  *      path="/v1/entities/travel-reservations/sort",
  *      operationId="sortTravelReservations",
  *      tags={"travel-reservations"},
  *      summary="Sort existing Travel Reservations",
  *      description="Sort existing Travel Reservations",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-reservations",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "customerId":"", "namePassanger":"Abc", "ktpPassanger":"123", "birthDate":"Abc", "category":"Abc", "minBudget":"123", "maxBudget":"123", "ticketStatus":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc", "isReserved":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "customerId":"", "namePassanger":"Abc", "ktpPassanger":"123", "birthDate":"Abc", "category":"Abc", "minBudget":"123", "maxBudget":"123", "ticketStatus":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "startingLocation":"Abc", "arrivalLocation":"Abc", "startingTerminal":"Abc", "arrivalTerminal":"Abc", "isReserved":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="namePassanger"), 
  *                         @OA\Property(type="integer", property="ktpPassanger"), 
  *                         @OA\Property(type="string", property="birthDate"), 
  *                         @OA\Property(type="string", property="category"), 
  *                         @OA\Property(type="integer", property="minBudget"), 
  *                         @OA\Property(type="integer", property="maxBudget"), 
  *                         @OA\Property(type="string", property="ticketStatus"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="startingDate"), 
  *                         @OA\Property(type="string", property="startingTime"), 
  *                         @OA\Property(type="string", property="startingLocation"), 
  *                         @OA\Property(type="string", property="arrivalLocation"), 
  *                         @OA\Property(type="string", property="startingTerminal"), 
  *                         @OA\Property(type="string", property="arrivalTerminal"), 
  *                         @OA\Property(type="string", property="isReserved"), 
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