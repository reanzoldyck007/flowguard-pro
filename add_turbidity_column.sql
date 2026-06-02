-- Run this once in phpMyAdmin to add turbidity column to tank_telemetry
ALTER TABLE `tank_telemetry`
  ADD COLUMN `turbidity_ntu` FLOAT NOT NULL DEFAULT 0
  COMMENT 'Turbidity in NTU from SEN0189 sensor'
  AFTER `oxygen`;
