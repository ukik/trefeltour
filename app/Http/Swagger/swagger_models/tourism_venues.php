<?php

/**
  * @OA\Get(
  *      path="/v1/entities/tourism-venues",
  *      operationId="browseWisataVendor",
  *      tags={"tourism-venues"},
  *      summary="Browse Wisata Vendor",
  *      description="Returns list of Wisata Vendor",
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
  *      path="/v1/entities/tourism-venues/read?slug=tourism-venues&id={id}",
  *      operationId="readWisataVendor",
  *      tags={"tourism-venues"},
  *      summary="Get Wisata Vendor based on id",
  *      description="Returns Wisata Vendor based on id",
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
  *      path="/v1/entities/tourism-venues/add",
  *      operationId="addWisataVendor",
  *      tags={"tourism-venues"},
  *      summary="Insert new Wisata Vendor",
  *      description="Insert new Wisata Vendor into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "category":"Abc", "description":"Abc", "isAvailable":"Abc"},
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
  *      path="/v1/entities/tourism-venues/edit",
  *      operationId="editWisataVendor",
  *      tags={"tourism-venues"},
  *      summary="Edit an existing Wisata Vendor",
  *      description="Edit an existing Wisata Vendor",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "category":"Abc", "description":"Abc", "isAvailable":"Abc"},
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
  *      path="/v1/entities/tourism-venues/delete",
  *      operationId="deleteWisataVendor",
  *      tags={"tourism-venues"},
  *      summary="Delete one record of Wisata Vendor",
  *      description="Delete one record of Wisata Vendor",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="tourism-venues",
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
  *      path="/v1/entities/tourism-venues/delete-multiple",
  *      operationId="deleteMultipleWisataVendor",
  *      tags={"tourism-venues"},
  *      summary="Delete multiple record of Wisata Vendor",
  *      description="Delete multiple record of Wisata Vendor",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="tourism-venues",
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
  *      path="/v1/entities/tourism-venues/sort",
  *      operationId="sortWisataVendor",
  *      tags={"tourism-venues"},
  *      summary="Sort existing Wisata Vendor",
  *      description="Sort existing Wisata Vendor",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="tourism-venues",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "userId":"123", "name":"Abc", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "category":"Abc", "description":"Abc", "isAvailable":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "userId":"123", "name":"Abc", "dayOpen":"Abc", "dayClose":"Abc", "timeOpen":"Abc", "timeClose":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "category":"Abc", "description":"Abc", "isAvailable":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="integer", property="userId"), 
  *                         @OA\Property(type="string", property="name"), 
  *                         @OA\Property(type="string", property="dayOpen"), 
  *                         @OA\Property(type="string", property="dayClose"), 
  *                         @OA\Property(type="string", property="timeOpen"), 
  *                         @OA\Property(type="string", property="timeClose"), 
  *                         @OA\Property(type="string", property="email"), 
  *                         @OA\Property(type="string", property="phone"), 
  *                         @OA\Property(type="string", property="location"), 
  *                         @OA\Property(type="string", property="image"), 
  *                         @OA\Property(type="string", property="address"), 
  *                         @OA\Property(type="integer", property="codepos"), 
  *                         @OA\Property(type="string", property="city"), 
  *                         @OA\Property(type="string", property="country"), 
  *                         @OA\Property(type="string", property="policy"), 
  *                         @OA\Property(type="string", property="category"), 
  *                         @OA\Property(type="string", property="description"), 
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