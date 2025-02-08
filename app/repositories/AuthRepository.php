<?php
class AuthRepository extends NutribaseRepository {
    public function findUserByEmail(string $email): ?array {
        $results = $this->doQuery(
            'SELECT id, email, password_hash FROM users WHERE email = ?',
            [$email]
        );
        return !empty($results) ? $results[0] : null;
    }

    public function createUser(string $email, string $passwordHash): void {
        Logger::log("AuthRepository::createUser called for email: " . $email);

        $this->doQuery(
            'INSERT INTO users (email, password_hash) VALUES (?, ?)',
            [$email, $passwordHash]
        );
    }

    public function updatePasswordHash(int $userId, string $newHash): void {
        $this->doQuery(
            'UPDATE users SET password_hash = ? WHERE id = ?',
            [$newHash, $userId]
        );
    }
}
