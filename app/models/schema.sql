/*
Home
	Products
		Product 1
		Product 2
		Product 3
		Product 4
	Portfolio
	Gallery
News
About
	History
Sitemap
Contact
	Location
	Form
*/
CREATE TABLE sitemap (
    "id" INTEGER NOT NULL,
    "parentId" INTEGER,
    "name" TEXT,
    "slug" TEXT
, "position" INTEGER)
	
INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (1, NULL, 'Home', 'home', 1);
	INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (2, 1, 'Products', '', 1);
		INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (3, 2, 'Product 1', 'product-1', 1);
		INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (4, 2, 'Product 2', 'product-2', 2);
		INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (5, 2, 'Product 3', 'product-3', 3);
		INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (6, 2, 'Product 4', 'product-4', 4);
	INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (7, 1, 'Portfolio', 'portfolio', 2);
	INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (8, 1, 'Gallery', 'gallery', 3);
INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (9, NULL, 'News', 'news', 2);
INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (10, NULL, 'About', 'about', 3);
	INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (11, 10, 'History', 'history', 1);
	INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (12, 10, 'Contact', 'contact', 2);
		INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (13, 12, 'Form', 'form', 1);
		INSERT INTO sitemap (id, parentId, name, slug, position) VALUES (14, 12, 'Location', 'location', 2);
