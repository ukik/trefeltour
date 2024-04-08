<?php

/**
  * @OA\Get(
  *      path="/v1/entities/transport-payments",
  *      operationId="browseTransportPembayaran",
  *      tags={"transport-payments"},
  *      summary="Browse Transport Pembayaran",
  *      description="Returns list of Transport Pembayaran",
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
  *      path="/v1/entities/transport-payments/read?slug=transport-payments&id={id}",
  *      operationId="readTransportPembayaran",
  *      tags={"transport-payments"},
  *      summary="Get Transport Pembayaran based on id",
  *      description="Returns Transport Pembayaran based on id",
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
  *      path="/v1/entities/transport-payments/add",
  *      operationId="addTransportPembayaran",
  *      tags={"transport-payments"},
  *      summary="Insert new Transport Pembayaran",
  *      description="Insert new Transport Pembayaran into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"totalAmount":"123", "totalAmountDriver":"123", "totalAmountAll":"123", "codeTransaction":"Abc", "method":"Abc", "date":"Abc", "status":"Abc", "receipt":"Abc", "description":"Abc"},
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
  *      path="/v1/entities/transport-payments/edit",
  *      operationId="editTransportPembayaran",
  *      tags={"transport-payments"},
  *      summary="Edit an existing Transport Pembayaran",
  *      description="Edit an existing Transport Pembayaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"totalAmount":"123", "totalAmountDriver":"123", "totalAmountAll":"123", "codeTransaction":"Abc", "method":"Abc", "date":"Abc", "status":"Abc", "receipt":"Abc", "description":"Abc"},
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
  *      path="/v1/entities/transport-payments/delete",
  *      operationId="deleteTransportPembayaran",
  *      tags={"transport-payments"},
  *      summary="Delete one record of Transport Pembayaran",
  *      description="Delete one record of Transport Pembayaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-payments",
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
  *      path="/v1/entities/transport-payments/delete-multiple",
  *      operationId="deleteMultipleTransportPembayaran",
  *      tags={"transport-payments"},
  *      summary="Delete multiple record of Transport Pembayaran",
  *      description="Delete multiple record of Transport Pembayaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-payments",
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
  *      path="/v1/entities/transport-payments/sort",
  *      operationId="sortTransportPembayaran",
  *      tags={"transport-payments"},
  *      summary="Sort existing Transport Pembayaran",
  *      description="Sort existing Transport Pembayaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-payments",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "bookingId":"", "customerId":"", "driverId":"", "uuid":"Abc", "totalAmount":"123", "totalAmountDriver":"123", "totalAmountAll":"123", "codeTransaction":"Abc", "method":"Abc", "date":"Abc", "status":"Abc", "receipt":"Abc", "description":"Abc", "isSelected":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "bookingId":"", "customerId":"", "driverId":"", "uuid":"Abc", "totalAmount":"123", "totalAmountDriver":"123", "totalAmountAll":"123", "codeTransaction":"Abc", "method":"Abc", "date":"Abc", "status":"Abc", "receipt":"Abc", "description":"Abc", "isSelected":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="bookingId"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="driverId"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="integer", property="totalAmount"), 
  *                         @OA\Property(type="integer", property="totalAmountDriver"), 
  *                         @OA\Property(type="integer", property="totalAmountAll"), 
  *                         @OA\Property(type="string", property="codeTransaction"), 
  *                         @OA\Property(type="string", property="method"), 
  *                         @OA\Property(type="string", property="date"), 
  *                         @OA\Property(type="string", property="status"), 
  *                         @OA\Property(type="string", property="receipt"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="isSelected"), 
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