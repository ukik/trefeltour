<?php

namespace Database\Seeders\Badaso\CRUD;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Traits\Seedable;

class BadasoDeploymentOrchestratorSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = 'database/seeders/Badaso/CRUD/';

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->seed(BranchesCRUDDataTypeAdded::class);
        $this->seed(BranchesCRUDDataRowAdded::class);
        $this->seed(CarsCRUDDataTypeAdded::class);
        $this->seed(CarsCRUDDataRowAdded::class);
        $this->seed(EmployeesCRUDDataTypeAdded::class);
        $this->seed(EmployeesCRUDDataRowAdded::class);
        $this->seed(RentalsCRUDDataTypeAdded::class);
        $this->seed(RentalsCRUDDataRowAdded::class);
        $this->seed(PaymentsCRUDDataTypeAdded::class);
        $this->seed(PaymentsCRUDDataRowAdded::class);
        
        
        $this->seed(CinemaStudiosCRUDDataTypeAdded::class);
        $this->seed(CinemaStudiosCRUDDataRowAdded::class);
        $this->seed(CinemaShowsCRUDDataTypeAdded::class);
        $this->seed(CinemaShowsCRUDDataRowAdded::class);
        $this->seed(CinemaSeatsCRUDDataTypeAdded::class);
        $this->seed(CinemaSeatsCRUDDataRowAdded::class);
        $this->seed(CinemaTicketsCRUDDataTypeAdded::class);
        $this->seed(CinemaTicketsCRUDDataRowAdded::class);
        $this->seed(CinemaPaymentsCRUDDataTypeAdded::class);
        $this->seed(CinemaPaymentsCRUDDataRowAdded::class);
        $this->seed(CinemaGenresCRUDDataTypeAdded::class);
        $this->seed(CinemaGenresCRUDDataRowAdded::class);
        $this->seed(CinemaMoviesCRUDDataDeleted::class);
        $this->seed(CinemaMoviesCRUDDataTypeAdded::class);
        $this->seed(CinemaMoviesCRUDDataRowAdded::class);
        
        
        $this->seed(KampusRoomsCRUDDataDeleted::class);
        $this->seed(CampusRoomsCRUDDataTypeAdded::class);
        $this->seed(CampusRoomsCRUDDataRowAdded::class);
        $this->seed(CampusCoursesCRUDDataTypeAdded::class);
        $this->seed(CampusCoursesCRUDDataRowAdded::class);
        
        
        $this->seed(CampusLecturesCRUDDataDeleted::class);
        $this->seed(CampusLecturersCRUDDataTypeAdded::class);
        $this->seed(CampusLecturersCRUDDataRowAdded::class);
        
        
        $this->seed(CampusBookingsCRUDDataDeleted::class);
        $this->seed(CampusBookingsCRUDDataTypeAdded::class);
        $this->seed(CampusBookingsCRUDDataRowAdded::class);
        
        
        $this->seed(TravelReservationsCRUDDataDeleted::class);
        
        
        
        
        
        
        $this->seed(TravelPaymentsCRUDDataDeleted::class);
        $this->seed(TravelPaymentsCRUDDataTypeAdded::class);
        $this->seed(TravelPaymentsCRUDDataRowAdded::class);
        
        
        $this->seed(TravelBookingsCRUDDataDeleted::class);
        
        
        
        
        
        
        $this->seed(TravelTicketsCRUDDataDeleted::class);
        $this->seed(TravelTicketsCRUDDataTypeAdded::class);
        $this->seed(TravelTicketsCRUDDataRowAdded::class);
        $this->seed(TravelReservationsCRUDDataTypeAdded::class);
        $this->seed(TravelReservationsCRUDDataRowAdded::class);
        $this->seed(TravelBookingsCRUDDataTypeAdded::class);
        $this->seed(TravelBookingsCRUDDataRowAdded::class);
        $this->seed(TravelPaymentsValidationsCRUDDataTypeAdded::class);
        $this->seed(TravelPaymentsValidationsCRUDDataRowAdded::class);
        $this->seed(TransportWorkshopsCRUDDataTypeAdded::class);
        $this->seed(TransportWorkshopsCRUDDataRowAdded::class);
        
        
        
        
        $this->seed(TransportReturnsCRUDDataTypeAdded::class);
        $this->seed(TransportReturnsCRUDDataRowAdded::class);
        $this->seed(TransportMaintenancesCRUDDataTypeAdded::class);
        $this->seed(TransportMaintenancesCRUDDataRowAdded::class);
        $this->seed(TransportDriversCRUDDataTypeAdded::class);
        $this->seed(TransportDriversCRUDDataRowAdded::class);
        $this->seed(TransportPaymentsCRUDDataTypeAdded::class);
        $this->seed(TransportPaymentsCRUDDataRowAdded::class);
        $this->seed(TransportPaymentsValidationsCRUDDataTypeAdded::class);
        $this->seed(TransportPaymentsValidationsCRUDDataRowAdded::class);
        $this->seed(TransportStoresCRUDDataDeleted::class);
        $this->seed(TransportRentalsCRUDDataTypeAdded::class);
        $this->seed(TransportRentalsCRUDDataRowAdded::class);
        $this->seed(TransportVehiclesCRUDDataDeleted::class);
        $this->seed(TransportVehiclesCRUDDataTypeAdded::class);
        $this->seed(TransportVehiclesCRUDDataRowAdded::class);
        $this->seed(TransportBookingsCRUDDataTypeAdded::class);
        $this->seed(TransportBookingsCRUDDataRowAdded::class);
        $this->seed(TourismBookingsCRUDDataTypeAdded::class);
        $this->seed(TourismBookingsCRUDDataRowAdded::class);
        
        
        $this->seed(TourismFacilitiesCRUDDataTypeAdded::class);
        $this->seed(TourismFacilitiesCRUDDataRowAdded::class);
        
        
        $this->seed(TourismPaymentsValidationsCRUDDataTypeAdded::class);
        $this->seed(TourismPaymentsValidationsCRUDDataRowAdded::class);
        $this->seed(TourismServicesCRUDDataTypeAdded::class);
        $this->seed(TourismServicesCRUDDataRowAdded::class);
        
        
        $this->seed(TourismCategoriesCRUDDataDeleted::class);
        $this->seed(TourismPricesCRUDDataTypeAdded::class);
        $this->seed(TourismPricesCRUDDataRowAdded::class);
        $this->seed(BadasoUsersCRUDDataTypeAdded::class);
        $this->seed(BadasoUsersCRUDDataRowAdded::class);
        $this->seed(TourismVenuesCRUDDataDeleted::class);
        $this->seed(TourismVenuesCRUDDataTypeAdded::class);
        $this->seed(TourismVenuesCRUDDataRowAdded::class);
        $this->seed(TourismPaymentsCRUDDataDeleted::class);
        $this->seed(TourismPaymentsCRUDDataTypeAdded::class);
        $this->seed(TourismPaymentsCRUDDataRowAdded::class);
        $this->seed(TalentBookingsCRUDDataTypeAdded::class);
        $this->seed(TalentBookingsCRUDDataRowAdded::class);
        $this->seed(TalentPaymentsCRUDDataTypeAdded::class);
        $this->seed(TalentPaymentsCRUDDataRowAdded::class);
        
        
        $this->seed(TalentPaymentsValidationsCRUDDataDeleted::class);
        $this->seed(TalentPaymentsValidationsCRUDDataTypeAdded::class);
        $this->seed(TalentPaymentsValidationsCRUDDataRowAdded::class);
        
        
        
        
        $this->seed(TalentProfilesCRUDDataTypeAdded::class);
        $this->seed(TalentProfilesCRUDDataRowAdded::class);
        $this->seed(TalentSkillsCRUDDataDeleted::class);
        $this->seed(TalentSkillsCRUDDataTypeAdded::class);
        $this->seed(TalentSkillsCRUDDataRowAdded::class);
        $this->seed(TalentPricesCRUDDataDeleted::class);
        
        
        $this->seed(TalentPricesCRUDDataTypeAdded::class);
        $this->seed(TalentPricesCRUDDataRowAdded::class);
    }
}
