

## VaxTrack

VaxTrack is an electronic immunization registry system designed to streamline and enhance the immunization process. It provides a user-friendly platform for healthcare providers, parents, and caregivers, improving the accuracy, accessibility, and efficiency of vaccine record-keeping, communication, and scheduling.

## Features

- **Vaccinations**: Maintain a central database of vaccination records, including patient details, administered vaccines, dates, locations, healthcare providers, and SMS notification status.
- **Patients**: Store patient information, such as name, date of birth, address, phone number, guardian's name, and SMS subscription status.
- **Vaccines**: Maintain a catalog of vaccines with names, recommended ages, and potential side effects.
- **Vaccine Schedules**: Associate vaccines with specific schedules, including recommended due dates, to track adherence and vaccination timelines.
- **Notifications**: Send automated SMS reminders to parents and caregivers about upcoming vaccination due dates.
- **Reporting and Analytics**: Monitor vaccination coverage rates, identify areas for improvement, and allocate resources effectively through reporting and analytics features.
- **User Management**: Secure access and permissions for healthcare providers, administrators, parents, and caregivers.

## Installation

To install and set up VaxTrack, follow the steps below:

### Prerequisites

- PHP and Composer installed on your machine.
- A database server (e.g., MySQL) and a created database for VaxTrack.

### Installation Steps

1. Clone the Repository:
   ```
   git clone <https://github.com/JKabaru/VaxTrack.git>
   ```

2. Install Dependencies:
   
   ```
To run this Laravel project, you need to have the following dependencies installed on your system:

PHP: Laravel is built on PHP, and you'll need to have PHP installed. The project requires PHP version 7.4 or higher.

Composer: Laravel uses Composer to manage its dependencies. If you don't have Composer installed, you can download it from the official website: Composer

Laravel Framework: This project relies on the Laravel framework, which is included in the project's composer.json file. After cloning the repository, run the following command to install the required packages:
   cd vaxtrack
   composer install
   ```

4. Environment Setup:
   - Create a copy of the `.env.example` file and rename it to `.env`.
   - Update the `.env` file with your database and application configurations.

5. Generate Application Key:
   ```
   php artisan key:generate
   ```

6. Run Migrations:
   ```
   php artisan migrate
   ```

7. (Optional) Seed Database:
   ```
   php artisan db:seed
   ```

8. Start the Development Server:
   ```
   php artisan serve
   ```

9. Access the Application:
   Open your web browser and visit the URL provided by the development server.

## Contributing

Contributions to VaxTrack are welcome! Please follow the guidelines in the [CONTRIBUTING.md](CONTRIBUTING.md) file.

## License

VaxTrack is open-source software licensed under the [MIT license](LICENSE).

## Support

If you have any questions or need assistance, please reach out to our support team at [support@vaxtrack.com](mailto:support@vaxtrack.com).

## Acknowledgements

VaxTrack has been made possible thanks to the contributions and support of various individuals and organizations. We extend our gratitude to all who have helped in the development and improvement of this system.

## Disclaimer

VaxTrack is intended for informational purposes only and should not substitute professional medical advice or guidance. Always consult healthcare professionals for personalized medical recommendations and decisions.

## Admin Credentials

- Email: admin@gmail.com
- Password: 12345678
