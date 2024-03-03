<?php

/**
  * @OA\Get(
  *      path="/v1/entities/lodge-profiles",
  *      operationId="browseLodgeProfiles",
  *      tags={"lodge-profiles"},
  *      summary="Browse Lodge Profiles",
  *      description="Returns list of Lodge Profiles",
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
  *      path="/v1/entities/lodge-profiles/read?slug=lodge-profiles&id={id}",
  *      operationId="readLodgeProfiles",
  *      tags={"lodge-profiles"},
  *      summary="Get Lodge Profiles based on id",
  *      description="Returns Lodge Profiles based on id",
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
  *      path="/v1/entities/lodge-profiles/add",
  *      operationId="addLodgeProfiles",
  *      tags={"lodge-profiles"},
  *      summary="Insert new Lodge Profiles",
  *      description="Insert new Lodge Profiles into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "description":"Abc", "rating":"Abc", "checkinTime":"Abc", "checkoutTime":"Abc", "additionalPolicy":"Abc", "shuttleToAirportPrice":"123", "additionalBreakfastPrice":"123", "lateCheckoutPrice":"123", "isCleanAccomodation":"Abc", "isBreakfast":"Abc", "isPet":"Abc", "isAvailable":"Abc"},
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
  *      path="/v1/entities/lodge-profiles/edit",
  *      operationId="editLodgeProfiles",
  *      tags={"lodge-profiles"},
  *      summary="Edit an existing Lodge Profiles",
  *      description="Edit an existing Lodge Profiles",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "description":"Abc", "rating":"Abc", "checkinTime":"Abc", "checkoutTime":"Abc", "additionalPolicy":"Abc", "shuttleToAirportPrice":"123", "additionalBreakfastPrice":"123", "lateCheckoutPrice":"123", "isCleanAccomodation":"Abc", "isBreakfast":"Abc", "isPet":"Abc", "isAvailable":"Abc"},
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
  *      path="/v1/entities/lodge-profiles/delete",
  *      operationId="deleteLodgeProfiles",
  *      tags={"lodge-profiles"},
  *      summary="Delete one record of Lodge Profiles",
  *      description="Delete one record of Lodge Profiles",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-profiles",
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
  *      path="/v1/entities/lodge-profiles/delete-multiple",
  *      operationId="deleteMultipleLodgeProfiles",
  *      tags={"lodge-profiles"},
  *      summary="Delete multiple record of Lodge Profiles",
  *      description="Delete multiple record of Lodge Profiles",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-profiles",
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
  *      path="/v1/entities/lodge-profiles/sort",
  *      operationId="sortLodgeProfiles",
  *      tags={"lodge-profiles"},
  *      summary="Sort existing Lodge Profiles",
  *      description="Sort existing Lodge Profiles",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="lodge-profiles",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "userId":"", "uuid":"Abc", "name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "description":"Abc", "rating":"Abc", "checkinTime":"Abc", "checkoutTime":"Abc", "additionalPolicy":"Abc", "shuttleToAirportPrice":"123", "additionalBreakfastPrice":"123", "lateCheckoutPrice":"123", "isCleanAccomodation":"Abc", "isBreakfast":"Abc", "isPet":"Abc", "isAvailable":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}, {"id":"123", "userId":"", "uuid":"Abc", "name":"Abc", "email":"Abc", "phone":"Abc", "location":"Abc", "image":"Abc", "address":"Abc", "codepos":"123", "city":"Abc", "country":"Abc", "policy":"Abc", "description":"Abc", "rating":"Abc", "checkinTime":"Abc", "checkoutTime":"Abc", "additionalPolicy":"Abc", "shuttleToAirportPrice":"123", "additionalBreakfastPrice":"123", "lateCheckoutPrice":"123", "isCleanAccomodation":"Abc", "isBreakfast":"Abc", "isPet":"Abc", "isAvailable":"Abc", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "deletedAt":"2021-01-01T00:00:00.000Z"}},
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
  *                         @OA\Property(type="string", property="city"), 
  *                         @OA\Property(type="string", property="country"), 
  *                         @OA\Property(type="string", property="policy"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="string", property="rating"), 
  *                         @OA\Property(type="string", property="checkinTime"), 
  *                         @OA\Property(type="string", property="checkoutTime"), 
  *                         @OA\Property(type="string", property="additionalPolicy"), 
  *                         @OA\Property(type="integer", property="shuttleToAirportPrice"), 
  *                         @OA\Property(type="integer", property="additionalBreakfastPrice"), 
  *                         @OA\Property(type="integer", property="lateCheckoutPrice"), 
  *                         @OA\Property(type="string", property="isCleanAccomodation"), 
  *                         @OA\Property(type="string", property="isBreakfast"), 
  *                         @OA\Property(type="string", property="isPet"), 
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