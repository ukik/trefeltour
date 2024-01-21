<?php

/**
  * @OA\Get(
  *      path="/v1/entities/travel-reservations",
  *      operationId="browseTravelReservasi",
  *      tags={"travel-reservations"},
  *      summary="Browse Travel Reservasi",
  *      description="Returns list of Travel Reservasi",
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
  *      operationId="readTravelReservasi",
  *      tags={"travel-reservations"},
  *      summary="Get Travel Reservasi based on id",
  *      description="Returns Travel Reservasi based on id",
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
  *      operationId="addTravelReservasi",
  *      tags={"travel-reservations"},
  *      summary="Insert new Travel Reservasi",
  *      description="Insert new Travel Reservasi into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"customerId":"", "codeTable":"Abc", "category":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "minBudget":"123", "maxBudget":"123", "startingLocation":"Abc", "arrivalLocation":"Abc", "isReserved":"Abc", "isCancel":"Abc", "uuid":"Abc"},
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
  *      operationId="editTravelReservasi",
  *      tags={"travel-reservations"},
  *      summary="Edit an existing Travel Reservasi",
  *      description="Edit an existing Travel Reservasi",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"customerId":"", "codeTable":"Abc", "category":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "minBudget":"123", "maxBudget":"123", "startingLocation":"Abc", "arrivalLocation":"Abc", "isReserved":"Abc", "isCancel":"Abc", "uuid":"Abc"},
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
  *      operationId="deleteTravelReservasi",
  *      tags={"travel-reservations"},
  *      summary="Delete one record of Travel Reservasi",
  *      description="Delete one record of Travel Reservasi",
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
  *      operationId="deleteMultipleTravelReservasi",
  *      tags={"travel-reservations"},
  *      summary="Delete multiple record of Travel Reservasi",
  *      description="Delete multiple record of Travel Reservasi",
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
  *      operationId="sortTravelReservasi",
  *      tags={"travel-reservations"},
  *      summary="Sort existing Travel Reservasi",
  *      description="Sort existing Travel Reservasi",
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
  *                     example={{"id":"123", "customerId":"", "codeTable":"Abc", "category":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "minBudget":"123", "maxBudget":"123", "startingLocation":"Abc", "arrivalLocation":"Abc", "isReserved":"Abc", "isCancel":"Abc", "createdAt":"Abc", "updatedAt":"Abc", "uuid":"Abc"}, {"id":"123", "customerId":"", "codeTable":"Abc", "category":"Abc", "description":"Abc", "startingDate":"Abc", "startingTime":"Abc", "minBudget":"123", "maxBudget":"123", "startingLocation":"Abc", "arrivalLocation":"Abc", "isReserved":"Abc", "isCancel":"Abc", "createdAt":"Abc", "updatedAt":"Abc", "uuid":"Abc"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="codeTable"), 
  *                         @OA\Property(type="string", property="category"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="startingDate"), 
  *                         @OA\Property(type="string", property="startingTime"), 
  *                         @OA\Property(type="integer", property="minBudget"), 
  *                         @OA\Property(type="integer", property="maxBudget"), 
  *                         @OA\Property(type="string", property="startingLocation"), 
  *                         @OA\Property(type="string", property="arrivalLocation"), 
  *                         @OA\Property(type="string", property="isReserved"), 
  *                         @OA\Property(type="string", property="isCancel"), 
  *                         @OA\Property(type="string", property="createdAt"), 
  *                         @OA\Property(type="string", property="updatedAt"), 
  *                         @OA\Property(type="string", property="uuid"),
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