<?php

/**
  * @OA\Get(
  *      path="/v1/entities/tourism-services",
  *      operationId="browseWisataLayanan",
  *      tags={"tourism-services"},
  *      summary="Browse Wisata Layanan",
  *      description="Returns list of Wisata Layanan",
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
  *      path="/v1/entities/tourism-services/read?slug=tourism-services&id={id}",
  *      operationId="readWisataLayanan",
  *      tags={"tourism-services"},
  *      summary="Get Wisata Layanan based on id",
  *      description="Returns Wisata Layanan based on id",
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
  *      path="/v1/entities/tourism-services/add",
  *      operationId="addWisataLayanan",
  *      tags={"tourism-services"},
  *      summary="Insert new Wisata Layanan",
  *      description="Insert new Wisata Layanan into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"isToilet":"Abc", "isBathroom":"Abc", "isMushola":"Abc", "isRestArea":"Abc", "isBar":"Abc", "isCulinary":"Abc", "isSouvenir":"Abc", "isPark":"Abc", "isWifi":"Abc", "isSecurity":"Abc", "isMedic":"Abc"},
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
  *      path="/v1/entities/tourism-services/edit",
  *      operationId="editWisataLayanan",
  *      tags={"tourism-services"},
  *      summary="Edit an existing Wisata Layanan",
  *      description="Edit an existing Wisata Layanan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"isToilet":"Abc", "isBathroom":"Abc", "isMushola":"Abc", "isRestArea":"Abc", "isBar":"Abc", "isCulinary":"Abc", "isSouvenir":"Abc", "isPark":"Abc", "isWifi":"Abc", "isSecurity":"Abc", "isMedic":"Abc"},
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
  *      path="/v1/entities/tourism-services/delete",
  *      operationId="deleteWisataLayanan",
  *      tags={"tourism-services"},
  *      summary="Delete one record of Wisata Layanan",
  *      description="Delete one record of Wisata Layanan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="tourism-services",
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
  *      path="/v1/entities/tourism-services/delete-multiple",
  *      operationId="deleteMultipleWisataLayanan",
  *      tags={"tourism-services"},
  *      summary="Delete multiple record of Wisata Layanan",
  *      description="Delete multiple record of Wisata Layanan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="tourism-services",
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
  *      path="/v1/entities/tourism-services/sort",
  *      operationId="sortWisataLayanan",
  *      tags={"tourism-services"},
  *      summary="Sort existing Wisata Layanan",
  *      description="Sort existing Wisata Layanan",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="tourism-services",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "venueId":"", "uuid":"Abc", "isToilet":"Abc", "isBathroom":"Abc", "isMushola":"Abc", "isRestArea":"Abc", "isBar":"Abc", "isCulinary":"Abc", "isSouvenir":"Abc", "isPark":"Abc", "isWifi":"Abc", "isSecurity":"Abc", "isMedic":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "venueId":"", "uuid":"Abc", "isToilet":"Abc", "isBathroom":"Abc", "isMushola":"Abc", "isRestArea":"Abc", "isBar":"Abc", "isCulinary":"Abc", "isSouvenir":"Abc", "isPark":"Abc", "isWifi":"Abc", "isSecurity":"Abc", "isMedic":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="venueId"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="isToilet"), 
  *                         @OA\Property(type="string", property="isBathroom"), 
  *                         @OA\Property(type="string", property="isMushola"), 
  *                         @OA\Property(type="string", property="isRestArea"), 
  *                         @OA\Property(type="string", property="isBar"), 
  *                         @OA\Property(type="string", property="isCulinary"), 
  *                         @OA\Property(type="string", property="isSouvenir"), 
  *                         @OA\Property(type="string", property="isPark"), 
  *                         @OA\Property(type="string", property="isWifi"), 
  *                         @OA\Property(type="string", property="isSecurity"), 
  *                         @OA\Property(type="string", property="isMedic"), 
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