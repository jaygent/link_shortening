# link_shortening

Setup
folder config db file, connection to the database (specify the data to connect to the database)

Creating a table for this project
CREATE TABLE `link_url` (
  `id` int(11) NOT NULL,
  `url` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_url` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `link_url`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `link_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;
