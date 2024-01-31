<?php

/**
  * @OA\Get(
  *      path="/v1/entities/transport-workshops",
  *      operationId="browseTransportBengkel",
  *      tags={"transport-workshops"},
  *      summary="Browse Transport Bengkel",
  *      description="Returns list of Transport Bengkel",
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
  *      path="/v1/entities/transport-workshops/read?slug=transport-workshops&id={id}",
  *      operationId="readTransportBengkel",
  *      tags={"transport-workshops"},
  *      summary="Get Transport Bengkel based on id",
  *      description="Returns Transport Bengkel based on id",
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
  *      path="/v1/entities/transport-workshops/add",
  *      operationId="addTransportBengkel",
  *      tags={"transport-workshops"},
  *      summary="Insert new Transport Bengkel",
  *      description="Insert new Transport Bengkel into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "country":"Abc", "city":"Abc", "policy":"Abc", "category":"Abc", "yearExp":"123", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "codeTable":"Abc"},
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
  *      path="/v1/entities/transport-workshops/edit",
  *      operationId="editTransportBengkel",
  *      tags={"transport-workshops"},
  *      summary="Edit an existing Transport Bengkel",
  *      description="Edit an existing Transport Bengkel",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "country":"Abc", "city":"Abc", "policy":"Abc", "category":"Abc", "yearExp":"123", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "codeTable":"Abc"},
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
  *      path="/v1/entities/transport-workshops/delete",
  *      operationId="deleteTransportBengkel",
  *      tags={"transport-workshops"},
  *      summary="Delete one record of Transport Bengkel",
  *      description="Delete one record of Transport Bengkel",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-workshops",
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
  *      path="/v1/entities/transport-workshops/delete-multiple",
  *      operationId="deleteMultipleTransportBengkel",
  *      tags={"transport-workshops"},
  *      summary="Delete multiple record of Transport Bengkel",
  *      description="Delete multiple record of Transport Bengkel",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-workshops",
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
  *      path="/v1/entities/transport-workshops/sort",
  *      operationId="sortTransportBengkel",
  *      tags={"transport-workshops"},
  *      summary="Sort existing Transport Bengkel",
  *      description="Sort existing Transport Bengkel",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="transport-workshops",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "userId":"", "uuid":"Abc", "name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "country":"Abc", "city":"Abc", "policy":"Abc", "category":"Abc", "yearExp":"123", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "userId":"", "uuid":"Abc", "name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "country":"Abc", "city":"Abc", "policy":"Abc", "category":"Abc", "yearExp":"123", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="userId"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="name"), 
  *                         @OA\Property(type="string", property="email"), 
  *                         @OA\Property(type="string", property="phone"), 
  *                         @OA\Property(type="string", property="location"), 
  *                         @OA\Property(type="string", property="image"), 
  *                         @OA\Property(type="string", property="address"), 
  *                         @OA\Property(type="integer", property="codepos"), 
  *                         @OA\Property(type="string", property="country"), 
  *                         @OA\Property(type="string", property="city"), 
  *                         @OA\Property(type="string", property="policy"), 
  *                         @OA\Property(type="string", property="category"), 
  *                         @OA\Property(type="integer", property="yearExp"), 
  *                         @OA\Property(type="string", property="dayOpen"), 
  *                         @OA\Property(type="string", property="dayClose"), 
  *                         @OA\Property(type="string", property="timeOpen"), 
  *                         @OA\Property(type="string", property="timeClose"), 
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