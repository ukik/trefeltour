<?php

/**
  * @OA\Get(
  *      path="/v1/entities/offers",
  *      operationId="browseDataPenawaran",
  *      tags={"offers"},
  *      summary="Browse Data Penawaran",
  *      description="Returns list of Data Penawaran",
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
  *      path="/v1/entities/offers/read?slug=offers&id={id}",
  *      operationId="readDataPenawaran",
  *      tags={"offers"},
  *      summary="Get Data Penawaran based on id",
  *      description="Returns Data Penawaran based on id",
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
  *      path="/v1/entities/offers/add",
  *      operationId="addDataPenawaran",
  *      tags={"offers"},
  *      summary="Insert new Data Penawaran",
  *      description="Insert new Data Penawaran into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "whatsapp":"Abc", "email":"Abc", "type":"Abc", "instance":"Abc", "category":"Abc", "participant":"123", "minBudget":"123", "maxBudget":"123", "startingDate":"Abc", "endDate":"Abc", "startingLocation":"Abc", "destination":"Abc", "description":"Abc", "imageProsposal":"Abc", "fileProsposal":"Abc", "isFollowup":"Abc", "catatanFollowup":"Abc"},
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
  *      path="/v1/entities/offers/edit",
  *      operationId="editDataPenawaran",
  *      tags={"offers"},
  *      summary="Edit an existing Data Penawaran",
  *      description="Edit an existing Data Penawaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "whatsapp":"Abc", "email":"Abc", "type":"Abc", "instance":"Abc", "category":"Abc", "participant":"123", "minBudget":"123", "maxBudget":"123", "startingDate":"Abc", "endDate":"Abc", "startingLocation":"Abc", "destination":"Abc", "description":"Abc", "imageProsposal":"Abc", "fileProsposal":"Abc", "isFollowup":"Abc", "catatanFollowup":"Abc"},
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
  *      path="/v1/entities/offers/delete",
  *      operationId="deleteDataPenawaran",
  *      tags={"offers"},
  *      summary="Delete one record of Data Penawaran",
  *      description="Delete one record of Data Penawaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="offers",
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
  *      path="/v1/entities/offers/delete-multiple",
  *      operationId="deleteMultipleDataPenawaran",
  *      tags={"offers"},
  *      summary="Delete multiple record of Data Penawaran",
  *      description="Delete multiple record of Data Penawaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="offers",
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
  *      path="/v1/entities/offers/sort",
  *      operationId="sortDataPenawaran",
  *      tags={"offers"},
  *      summary="Sort existing Data Penawaran",
  *      description="Sort existing Data Penawaran",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="offers",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "userId":"", "userFollowupId":"", "name":"Abc", "whatsapp":"Abc", "email":"Abc", "type":"Abc", "instance":"Abc", "category":"Abc", "participant":"123", "minBudget":"123", "maxBudget":"123", "startingDate":"Abc", "endDate":"Abc", "startingLocation":"Abc", "destination":"Abc", "description":"Abc", "imageProsposal":"Abc", "fileProsposal":"Abc", "isFollowup":"Abc", "catatanFollowup":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "userId":"", "userFollowupId":"", "name":"Abc", "whatsapp":"Abc", "email":"Abc", "type":"Abc", "instance":"Abc", "category":"Abc", "participant":"123", "minBudget":"123", "maxBudget":"123", "startingDate":"Abc", "endDate":"Abc", "startingLocation":"Abc", "destination":"Abc", "description":"Abc", "imageProsposal":"Abc", "fileProsposal":"Abc", "isFollowup":"Abc", "catatanFollowup":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="userId"), 
  *                         @OA\Property(type="string", property="userFollowupId"), 
  *                         @OA\Property(type="string", property="name"), 
  *                         @OA\Property(type="string", property="whatsapp"), 
  *                         @OA\Property(type="string", property="email"), 
  *                         @OA\Property(type="string", property="type"), 
  *                         @OA\Property(type="string", property="instance"), 
  *                         @OA\Property(type="string", property="category"), 
  *                         @OA\Property(type="integer", property="participant"), 
  *                         @OA\Property(type="integer", property="minBudget"), 
  *                         @OA\Property(type="integer", property="maxBudget"), 
  *                         @OA\Property(type="string", property="startingDate"), 
  *                         @OA\Property(type="string", property="endDate"), 
  *                         @OA\Property(type="string", property="startingLocation"), 
  *                         @OA\Property(type="string", property="destination"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="imageProsposal"), 
  *                         @OA\Property(type="string", property="fileProsposal"), 
  *                         @OA\Property(type="string", property="isFollowup"), 
  *                         @OA\Property(type="string", property="catatanFollowup"), 
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