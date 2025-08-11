erDiagram
    direction TB
    USERS {
        INT id PK ""  
        VARCHAR email UK ""  
        VARCHAR name  ""  
        VARCHAR password  ""  
        VARCHAR phone  ""  
        TIMESTAMP created_at  ""  
    }
    TEAMMEMBERS {
        INT id PK ""  
        VARCHAR name  ""  
        VARCHAR role  ""  
        TEXT bio  ""  
        TEXT photo_url  ""  
        JSON social_links  ""  
        TIMESTAMP created_at  ""  
    }
    DESTINATIONS {
        INT id PK ""  
        VARCHAR name  ""  
        VARCHAR slug UK ""  
        VARCHAR country  ""  
        TEXT description  ""  
    }
    PACKAGES {
        INT id PK ""  
        VARCHAR slug UK ""  
        VARCHAR title  ""  
        TEXT itineraries  ""  
        DECIMAL price  ""  
        VARCHAR location FK ""  
        INT duration_days  ""  
        INT available_spots  ""  
        TEXT image_url  ""  
        INT created_by FK ""  
        INT seo_id FK ""  
        TIMESTAMP created_at  ""  
    }
    BOOKINGS {
        INT id PK ""  
        INT user_id FK ""  
        INT package_id FK ""  
        DATE booking_date  ""  
        INT number_of_people  ""  
        DECIMAL total_price  ""  
        DECIMAL vat_amount  ""  
        DECIMAL discount  ""  
        ENUM status  ""  
        TIMESTAMP created_at  ""  
    }
    PAYMENTS {
        INT id PK ""  
        INT booking_id FK,UK ""  
        VARCHAR payment_method  ""  
        DECIMAL amount  ""  
        TIMESTAMP payment_date  ""  
        TEXT status  ""  
    }
    REVIEWS {
        INT id PK ""  
        INT user_id FK ""  
        INT package_id FK ""  
        INT rating  ""  
        TEXT comment  ""  
        TIMESTAMP created_at  ""  
    }
    CONTACTMESSAGES {
        INT id PK ""  
        VARCHAR name  ""  
        VARCHAR email  ""  
        VARCHAR subject  ""  
        TEXT message  ""  
        TIMESTAMP created_at  ""  
    }
    CUSTOMTRIPQUERIES {
        INT id PK ""  
        INT user_id FK ""  
        VARCHAR name  ""  
        VARCHAR email  ""  
        VARCHAR phone  ""  
        VARCHAR preferred_location  ""  
        VARCHAR travel_dates  ""  
        INT number_of_people  ""  
        DECIMAL budget  ""  
        TEXT message  ""  
        ENUM status  ""  
        TIMESTAMP created_at  ""  
    }
    FAQS {
        INT id PK ""  
        INT package_id FK ""  
        VARCHAR question  ""  
        TEXT answer  ""  
        TIMESTAMP created_at  ""  
    }
    PAGES {
        INT id PK ""  
        VARCHAR slug UK ""  
        VARCHAR title  ""  
        TEXT content  ""  
        INT seo_id FK ""  
        JSON custom_fields  ""  
        TIMESTAMP created_at  ""  
        TIMESTAMP updated_at  ""  
    }
    BLOGS {
        INT id PK ""  
        VARCHAR slug UK ""  
        VARCHAR title  ""  
        TEXT content  ""  
        INT author_id FK ""  
        INT seo_id FK ""  
        TIMESTAMP published_at  ""  
        TIMESTAMP updated_at  ""  
    }
    SEOSETTINGS {
        INT id PK ""  
        VARCHAR meta_title  ""  
        TEXT meta_description  ""  
        TEXT meta_keywords  ""  
        JSON custom_fields  ""  
        TIMESTAMP created_at  ""  
    }
    SITESETTINGS {
        INT id PK ""  
        VARCHAR site_name  ""  
        TEXT logo_url  ""  
        VARCHAR contact_email  ""  
        VARCHAR phone_number  ""  
        TEXT address  ""  
        JSON social_links  ""  
        INT accessed_by FK ""  
        TIMESTAMP created_at  ""  
    }
    USERS||--o{BOOKINGS:"user_id"
    USERS||--o{REVIEWS:"user_id"
    USERS||--o{CUSTOMTRIPQUERIES:"user_id"
    TEAMMEMBERS||--o{PACKAGES:"created_by"
    TEAMMEMBERS||--o{BLOGS:"author_id"
    TEAMMEMBERS||--||SITESETTINGS:"accessed_by"
    PACKAGES||--o{BOOKINGS:"package_id"
    PACKAGES||--o{REVIEWS:"package_id"
    PACKAGES||--o{FAQS:"package_id"
    PACKAGES}o--||DESTINATIONS:"location"
    BOOKINGS||--||PAYMENTS:"booking_id"
    PAGES}o--||SEOSETTINGS:"seo_id"
    BLOGS}o--||SEOSETTINGS:"seo_id"
    PACKAGES}o--||SEOSETTINGS:"seo_id"
    style USERS stroke:#000000
    style TEAMMEMBERS stroke:#000000
    style DESTINATIONS stroke:#000000
    style PACKAGES stroke:#000000
    style BOOKINGS stroke:#000000
    style PAYMENTS stroke:#000000
    style REVIEWS stroke:#000000
    style CONTACTMESSAGES stroke:#000000
    style CUSTOMTRIPQUERIES stroke:#000000
    style FAQS stroke:#000000
    style PAGES stroke:#000000
    style BLOGS stroke:#000000
    style SEOSETTINGS stroke:#000000
    style SITESETTINGS stroke:#000000
