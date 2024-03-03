<?php

/**
  * @OA\Get(
  *      path="/v1/entities/lodge-facility",
  *      operationId="browseLodgeFacility",
  *      tags={"lodge-facility"},
  *      summary="Browse Lodge Facility",
  *      description="Returns list of Lodge Facility",
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
  *      path="/v1/entities/lodge-facility/read?slug=lodge-facility&id={id}",
  *      operationId="readLodgeFacility",
  *      tags={"lodge-facility"},
  *      summary="Get Lodge Facility based on id",
  *      description="Returns Lodge Facility based on id",
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
  *      path="/v1/entities/lodge-facility/add",
  *      operationId="addLodgeFacility",
  *      tags={"lodge-facility"},
  *      summary="Insert new Lodge Facility",
  *      description="Insert new Lodge Facility into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"facilitySport":"Abc", "facilityService":"Abc", "facilityPublic":"Abc", "facilityKidPet":"Abc", "facilityInRoom":"Abc", "facilityGeneral":"Abc", "facilityConnectivity":"Abc", "facilityBusiness":"Abc"},
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
  *      path="/v1/entities/lodge-facility/edit",
  *      operationId="editLodgeFacility",
  *      tags={"lodge-facility"},
  *      summary="Edit an existing Lodge Facility",
  *      description="Edit an existing Lodge Facility",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"facilitySport":"Abc", "facilityService":"Abc", "facilityPublic":"Abc", "facilityKidPet":"Abc", "facilityInRoom":"Abc", "facilityGeneral":"Abc", "facilityConnectivity":"Abc", "facilityBusiness":"Abc"},
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
  *      path="/v1/entities/lodge-facility/delete",
  *      operationId="deleteLodgeFacility",
  *      tags={"lodge-facility"},
  *      summary="Delete one record of Lodge Facility",
  *      description="Delete one record of Lodge Facility",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-facility",
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
  *      path="/v1/entities/lodge-facility/delete-multiple",
  *      operationId="deleteMultipleLodgeFacility",
  *      tags={"lodge-facility"},
  *      summary="Delete multiple record of Lodge Facility",
  *      description="Delete multiple record of Lodge Facility",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-facility",
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
  *      path="/v1/entities/lodge-facility/sort",
  *      operationId="sortLodgeFacility",
  *      tags={"lodge-facility"},
  *      summary="Sort existing Lodge Facility",
  *      description="Sort existing Lodge Facility",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-facility",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "uuid":"Abc", "profileId":"", "facilitySport":"Abc", "facilityService":"Abc", "facilityPublic":"Abc", "facilityKidPet":"Abc", "facilityInRoom":"Abc", "facilityGeneral":"Abc", "facilityConnectivity":"Abc", "facilityBusiness":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "uuid":"Abc", "profileId":"", "facilitySport":"Abc", "facilityService":"Abc", "facilityPublic":"Abc", "facilityKidPet":"Abc", "facilityInRoom":"Abc", "facilityGeneral":"Abc", "facilityConnectivity":"Abc", "facilityBusiness":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="uuid"), 
  *                         @OA\Property(type="string", property="profileId"), 
  *                         @OA\Property(type="string", property="facilitySport"), 
  *                         @OA\Property(type="string", property="facilityService"), 
  *                         @OA\Property(type="string", property="facilityPublic"), 
  *                         @OA\Property(type="string", property="facilityKidPet"), 
  *                         @OA\Property(type="string", property="facilityInRoom"), 
  *                         @OA\Property(type="string", property="facilityGeneral"), 
  *                         @OA\Property(type="string", property="facilityConnectivity"), 
  *                         @OA\Property(type="string", property="facilityBusiness"), 
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