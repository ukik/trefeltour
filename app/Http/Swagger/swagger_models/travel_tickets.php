<?php

/**
  * @OA\Get(
  *      path="/v1/entities/travel-tickets",
  *      operationId="browseTravelTickets",
  *      tags={"travel-tickets"},
  *      summary="Browse Travel Tickets",
  *      description="Returns list of Travel Tickets",
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
  *      path="/v1/entities/travel-tickets/read?slug=travel-tickets&id={id}",
  *      operationId="readTravelTickets",
  *      tags={"travel-tickets"},
  *      summary="Get Travel Tickets based on id",
  *      description="Returns Travel Tickets based on id",
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
  *      path="/v1/entities/travel-tickets/add",
  *      operationId="addTravelTickets",
  *      tags={"travel-tickets"},
  *      summary="Insert new Travel Tickets",
  *      description="Insert new Travel Tickets into database",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"seatNo":"Abc", "ticketStatus":"Abc", "nameUnit":"Abc", "travelDate":"2021-01-01T00:00:00.000Z", "description":"Abc", "ticketPrice":"123", "departureTerminal":"Abc", "arrivelTerminal":"Abc", "codeTicket":"Abc", "policy":"Abc", "images":"Abc", "ticketDiscountPrice":"123"},
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
  *      path="/v1/entities/travel-tickets/edit",
  *      operationId="editTravelTickets",
  *      tags={"travel-tickets"},
  *      summary="Edit an existing Travel Tickets",
  *      description="Edit an existing Travel Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="data",
  *                     type="object",
  *                     example={"seatNo":"Abc", "ticketStatus":"Abc", "nameUnit":"Abc", "travelDate":"2021-01-01T00:00:00.000Z", "description":"Abc", "ticketPrice":"123", "departureTerminal":"Abc", "arrivelTerminal":"Abc", "codeTicket":"Abc", "policy":"Abc", "images":"Abc", "ticketDiscountPrice":"123"},
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
  *      path="/v1/entities/travel-tickets/delete",
  *      operationId="deleteTravelTickets",
  *      tags={"travel-tickets"},
  *      summary="Delete one record of Travel Tickets",
  *      description="Delete one record of Travel Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-tickets",
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
  *      path="/v1/entities/travel-tickets/delete-multiple",
  *      operationId="deleteMultipleTravelTickets",
  *      tags={"travel-tickets"},
  *      summary="Delete multiple record of Travel Tickets",
  *      description="Delete multiple record of Travel Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-tickets",
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
  *      path="/v1/entities/travel-tickets/sort",
  *      operationId="sortTravelTickets",
  *      tags={"travel-tickets"},
  *      summary="Sort existing Travel Tickets",
  *      description="Sort existing Travel Tickets",
  *      @OA\RequestBody(
  *         @OA\MediaType(
  *             mediaType="application/json",
  *             @OA\Schema(
  *                 @OA\Property(
  *                     property="slug",
  *                     example="travel-tickets",
  *                     type="string"
  *                 ),
  *                 @OA\Property(
  *                     property="data",
  *                     type="array",
  *                     example={{"id":"123", "reservationId":"", "customerId":"", "seatNo":"Abc", "ticketStatus":"Abc", "nameUnit":"Abc", "travelDate":"2021-01-01T00:00:00.000Z", "description":"Abc", "ticketPrice":"123", "departureTerminal":"Abc", "arrivelTerminal":"Abc", "codeTicket":"Abc", "policy":"Abc", "images":"Abc", "ticketDiscountPrice":"123", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "uuid":"Abc"}, {"id":"123", "reservationId":"", "customerId":"", "seatNo":"Abc", "ticketStatus":"Abc", "nameUnit":"Abc", "travelDate":"2021-01-01T00:00:00.000Z", "description":"Abc", "ticketPrice":"123", "departureTerminal":"Abc", "arrivelTerminal":"Abc", "codeTicket":"Abc", "policy":"Abc", "images":"Abc", "ticketDiscountPrice":"123", "codeTable":"Abc", "createdAt":"2021-01-01T00:00:00.000Z", "updatedAt":"2021-01-01T00:00:00.000Z", "uuid":"Abc"}},
  *                     @OA\Items(
  *                         type="object",
  *                         @OA\Property(type="integer", property="id"), 
  *                         @OA\Property(type="string", property="reservationId"), 
  *                         @OA\Property(type="string", property="customerId"), 
  *                         @OA\Property(type="string", property="seatNo"), 
  *                         @OA\Property(type="string", property="ticketStatus"), 
  *                         @OA\Property(type="string", property="nameUnit"), 
  *                         @OA\Property(type="string", property="travelDate"), 
  *                         @OA\Property(type="string", property="description"), 
  *                         @OA\Property(type="integer", property="ticketPrice"), 
  *                         @OA\Property(type="string", property="departureTerminal"), 
  *                         @OA\Property(type="string", property="arrivelTerminal"), 
  *                         @OA\Property(type="string", property="codeTicket"), 
  *                         @OA\Property(type="string", property="policy"), 
  *                         @OA\Property(type="string", property="images"), 
  *                         @OA\Property(type="integer", property="ticketDiscountPrice"), 
  *                         @OA\Property(type="string", property="codeTable"), 
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