<?php

/**
  * @OA\Get(
  *      path="/v1/entities/cinema-tickets",
  *      operationId="browseCinemaTickets",
  *      tags={"cinema-tickets"},
  *      summary="Browse Cinema Tickets",
  *      description="Returns list of Cinema Tickets",
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
  *      path="/v1/entities/cinema-tickets/read?slug=cinema-tickets&id={id}",
  *      operationId="readCinemaTickets",
  *      tags={"cinema-tickets"},
  *      summary="Get Cinema Tickets based on id",
  *      description="Returns Cinema Tickets based on id",
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
  *      path="/v1/entities/cinema-tickets/add",
  *      operationId="addCinemaTickets",
  *      tags={"cinema-tickets"},
  *      summary="Insert new Cinema Tickets",
  *      description="Insert new Cinema Tickets into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"seatId":"", "userId":"", "movieId":"", "codeTicket":"Abc", "purchaseDate":"2021-01-01T00:00:00.000Z", "cinemaPayments":""},
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
  *      path="/v1/entities/cinema-tickets/edit",
  *      operationId="editCinemaTickets",
  *      tags={"cinema-tickets"},
  *      summary="Edit an existing Cinema Tickets",
  *      description="Edit an existing Cinema Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"seatId":"", "userId":"", "movieId":"", "codeTicket":"Abc", "purchaseDate":"2021-01-01T00:00:00.000Z", "cinemaPayments":""},
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
  *      path="/v1/entities/cinema-tickets/delete",
  *      operationId="deleteCinemaTickets",
  *      tags={"cinema-tickets"},
  *      summary="Delete one record of Cinema Tickets",
  *      description="Delete one record of Cinema Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="cinema-tickets",
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
  *      path="/v1/entities/cinema-tickets/delete-multiple",
  *      operationId="deleteMultipleCinemaTickets",
  *      tags={"cinema-tickets"},
  *      summary="Delete multiple record of Cinema Tickets",
  *      description="Delete multiple record of Cinema Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="cinema-tickets",
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
  *      path="/v1/entities/cinema-tickets/sort",
  *      operationId="sortCinemaTickets",
  *      tags={"cinema-tickets"},
  *      summary="Sort existing Cinema Tickets",
  *      description="Sort existing Cinema Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="cinema-tickets",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "seatId":"", "userId":"", "movieId":"", "codeTicket":"Abc", "purchaseDate":"2021-01-01T00:00:00.000Z", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "cinemaPayments":""}, {"id":"123", "seatId":"", "userId":"", "movieId":"", "codeTicket":"Abc", "purchaseDate":"2021-01-01T00:00:00.000Z", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "cinemaPayments":""}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="seatId"), 
  *                         @OA\Property(type="string", property="userId"), 
  *                         @OA\Property(type="string", property="movieId"), 
  *                         @OA\Property(type="string", property="codeTicket"), 
  *                         @OA\Property(type="string", property="purchaseDate"), 
  *                         @OA\Property(type="string", property="createdAt"), 
  *                         @OA\Property(type="string", property="updatedAt"), 
  *                         @OA\Property(type="string", property="cinemaPayments"),
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