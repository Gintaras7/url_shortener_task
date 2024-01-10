create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

INSERT INTO link_shortener.migrations (id, migration, batch) VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO link_shortener.migrations (id, migration, batch) VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO link_shortener.migrations (id, migration, batch) VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO link_shortener.migrations (id, migration, batch) VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO link_shortener.migrations (id, migration, batch) VALUES (5, '2024_01_11_144407_create_links_table', 1);
