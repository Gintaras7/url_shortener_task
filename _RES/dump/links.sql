create table links
(
    id         bigint unsigned auto_increment
        primary key,
    url        varchar(255) not null,
    hash       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    constraint links_hash_unique
        unique (hash),
    constraint links_url_unique
        unique (url)
)
    collate = utf8mb4_unicode_ci;

INSERT INTO link_shortener.links (id, url, hash, created_at, updated_at) VALUES (1, 'https://google.com', 'LG7xAo', '2024-01-14 13:45:44', '2024-01-14 13:45:44');
