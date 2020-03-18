<?php

class DateTime
{
    private function getConfigTimezone()
    {
    }

    public function date($date = null, $locale = null, $useTimezone = true, $includeTime = true)
    {
        $locale = $locale ? : $this->_localeResolver->getLocale();
        $timezone = $useTimezone
        ? $this->getConfigTimezone()
        : date_default_timezone_get();

        switch (true) {
			case (empty($date)):
				return new \DateTime('now', new \DateTimeZone($timezone));
			case ($date instanceof \DateTime):
				return $date->setTimezone(new \DateTimeZone($timezone));
			case ($date instanceof \DateTimeImmutable):
				return new \DateTime($date->format('Y-m-d H:i:s'), $date->getTimezone());
			case (!is_numeric($date)):
				$timeType = $includeTime ? \IntlDateFormatter::SHORT : \IntlDateFormatter::NONE;
				$formatter = new \IntlDateFormatter(
					$locale,
					\IntlDateFormatter::SHORT,
					$timeType,
					new \DateTimeZone($timezone)
				);

				$date = $this->appendTimeIfNeeded($date, $includeTime);
				$date = $formatter->parse($date) ?: (new \DateTime($date))->getTimestamp();
				break;
		}

        return (new \DateTime(null, new \DateTimeZone($timezone)))->setTimestamp($date);
    }

    private function appendTimeIfNeeded($date, $includeTime)
    {
        if ($includeTime && !preg_match('/\d{1}:\d{2}/', $date)) {
            $date .= " 0:00am";
        }
        return $date;
    }
}
