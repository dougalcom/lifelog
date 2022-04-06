SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database
--
CREATE DATABASE IF NOT EXISTS `lifelog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lifelog`;

-- --------------------------------------------------------

--
-- Table structure for table `lifelog`
--

CREATE TABLE `lifelog` (
  `id` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `mood` tinyint(4) DEFAULT NULL,
  `dateRecorded` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateSet` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lifelog`
--
ALTER TABLE `lifelog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lifelog`
--
ALTER TABLE `lifelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
