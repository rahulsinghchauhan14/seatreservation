CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
);

CREATE TABLE `seats` (
  `seat_id` bigint(20) UNSIGNED NOT NULL,
  `seat_number` int(11) NOT NULL,
  `row_number` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `is_booked` tinyint(1) NOT NULL DEFAULT 0,
  `booked_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);

ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD UNIQUE KEY `seats_seat_number_row_number_coach_id_unique` (`seat_number`,`row_number`,`coach_id`);

ALTER TABLE `seats`
  MODIFY `seat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;