-- Estrutura inicial para uma instalação nova.
CREATE TABLE IF NOT EXISTS users (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Username VARCHAR(80) NOT NULL,
    Email VARCHAR(254) NOT NULL,
    Age TINYINT UNSIGNED NOT NULL,
    Password VARCHAR(255) NOT NULL,
    PRIMARY KEY (Id),
    UNIQUE KEY users_email_unique (Email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Para uma tabela antiga que já existe, confira o tamanho da coluna Password.
-- Se for menor que 255 caracteres, execute a migração abaixo antes de usar novos cadastros:
-- ALTER TABLE users MODIFY COLUMN Password VARCHAR(255) NOT NULL;
