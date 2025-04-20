CREATE DATABASE db_lab;
USE db_lab;

CREATE TABLE gadgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    gadget_number VARCHAR(13) UNIQUE,
    quantity INT NOT NULL DEFAULT 0
);

CREATE TABLE lab_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(15)
);

CREATE TABLE experiments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gadget_id INT NOT NULL,
    member_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    FOREIGN KEY (gadget_id) REFERENCES gadgets(id),
    FOREIGN KEY (member_id) REFERENCES lab_members(id)
);

-- Insert sample gadgets from Steins;Gate
INSERT INTO gadgets (name, description, gadget_number, quantity) VALUES
('Phone Microwave (Name subject to change)', 'Device capable of sending messages to the past', 'FG001', 1),
('Divergence Meter', 'Measures the divergence between world lines', 'FG002', 2),
('Upa Detector', 'Detects metal Upa figures in the vicinity', 'FG003', 3);

-- Insert lab members
INSERT INTO lab_members (name, email, phone) VALUES
('Okabe Rintarou', 'hououin.kyouma@futuregadgetlab.com', '01234567890'),
('Makise Kurisu', 'christina@viktorslab.com', '09876543210'),
('Mayuri Shiina', 'tutturu@futuregadgetlab.com', '05678901234'),
('Itaru Hashida', 'supahacka@futuregadgetlab.com', '04567890123');

-- Insert experiments data
INSERT INTO experiments (gadget_id, member_id, start_date, end_date) VALUES
(1, 1, '2010-07-28', '2010-08-15'),
(1, 2, '2010-08-03', '2010-08-15'),
(2, 2, '2010-08-10', NULL),
(3, 3, '2010-08-01', '2010-08-05');