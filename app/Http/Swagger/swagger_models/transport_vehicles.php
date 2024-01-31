<?php

/**
  * @OA\Get(
  *      path="/v1/entities/transport-vehicles",
  *      operationId="browseTransportKendaraan",
  *      tags={"transport-vehicles"},
  *      summary="Browse Transport Kendaraan",
  *      description="Returns list of Transport Kendaraan",
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
  *      path="/v1/entities/transport-vehicles/read?slug=transport-vehicles&id={id}",
  *      operationId="readTransportKendaraan",
  *      tags={"transport-vehicles"},
  *      summary="Get Transport Kendaraan based on id",
  *      description="Returns Transport Kendaraan based on id",
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
  *      path="/v1/entities/transport-vehicles/add",
  *      operationId="addTransportKendaraan",
  *      tags={"transport-vehicles"},
  *      summary="Insert new Transport Kendaraan",
  *      description="Insert new Transport Kendaraan into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"model":"Abc", "brand":"Abc", "dailyPrice":"123", "discountDailyPrice":"123", "cashbackDailyPrice":"123", "category":"Abc", "fuelType":"Abc", "dateProduction":"Abc", "color":"Abc", "codeStnk":"Abc", "slotPassanger":"123", "isAvailable":"Abc"},
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
  *      path="/v1/entities/transport-vehicles/edit",
  *      operationId="editTransportKendaraan",
  *      tags={"transport-vehicles"},
  *      summary="Edit an existing Transport Kendaraan",
  *      description="Edit an existing Transport Kendaraan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"model":"Abc", "brand":"Abc", "dailyPrice":"123", "discountDailyPrice":"123", "cashbackDailyPrice":"123", "category":"Abc", "fuelType":"Abc", "dateProduction":"Abc", "color":"Abc", "codeStnk":"Abc", "slotPassanger":"123", "isAvailable":"Abc"},
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
  *      path="/v1/entities/transport-vehicles/delete",
  *      operationId="deleteTransportKendaraan",
  *      tags={"transport-vehicles"},
  *      summary="Delete one record of Transport Kendaraan",
  *      description="Delete one record of Transport Kendaraan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-vehicles",
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
  *      path="/v1/entities/transport-vehicles/delete-multiple",
  *      operationId="deleteMultipleTransportKendaraan",
  *      tags={"transport-vehicles"},
  *      summary="Delete multiple record of Transport Kendaraan",
  *      description="Delete multiple record of Transport Kendaraan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-vehicles",
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
  *      path="/v1/entities/transport-vehicles/sort",
  *      operationId="sortTransportKendaraan",
  *      tags={"transport-vehicles"},
  *      summary="Sort existing Transport Kendaraan",
  *      description="Sort existing Transport Kendaraan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-vehicles",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "rentalId":"", "uuid":"Abc", "model":"Abc", "brand":"Abc", "dailyPrice":"123", "discountDailyPrice":"123", "cashbackDailyPrice":"123", "category":"Abc", "fuelType":"Abc", "dateProduction":"Abc", "color":"Abc", "codeStnk":"Abc", "slotPassanger":"123", "isAvailable":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "rentalId":"", "uuid":"Abc", "model":"Abc", "brand":"Abc", "dailyPrice":"123", "discountDailyPrice":"123", "cashbackDailyPrice":"123", "category":"Abc", "fuelType":"Abc", "dateProduction":"Abc", "color":"Abc", "codeStnk":"Abc", "slotPassanger":"123", "isAvailable":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="rentalId"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="model"), 
  *                         @OA\Property(type="string", property="brand"), 
  *                         @OA\Property(type="integer", property="dailyPrice"), 
  *                         @OA\Property(type="integer", property="discountDailyPrice"), 
  *                         @OA\Property(type="integer", property="cashbackDailyPrice"), 
  *                         @OA\Property(type="string", property="category"), 
  *                         @OA\Property(type="string", property="fuelType"), 
  *                         @OA\Property(type="string", property="dateProduction"), 
  *                         @OA\Property(type="string", property="color"), 
  *                         @OA\Property(type="string", property="codeStnk"), 
  *                         @OA\Property(type="integer", property="slotPassanger"), 
  *                         @OA\Property(type="string", property="isAvailable"), 
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