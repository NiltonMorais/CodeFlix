CREATE TABLE IF NOT EXISTS users(
  id INTEGER PRIMARY KEY,
  `name` VARCHAR(255),
  email VARCHAR(255),
  CONSTRAINT email_unique UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS videos(
  id INTEGER PRIMARY KEY,
  title VARCHAR(255),
  description VARCHAR(255),
  duration INTEGER,
  thumb_url VARCHAR(255),
  file_url VARCHAR(255),
  serie_title VARCHAR(255) NULL,
  user_id INTEGER,
  categories_name TEXT,
  created_at DATETIME
);