@import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css');

body {
    font-family: 'Vazirmatn', 'Vazir', Tahoma, sans-serif;
    background-color: #f4f7fa;
    color: #333;
    margin: 0;
    padding: 0;
    direction: rtl;
}

.site-header {
    background-color: #1976d2;
    padding: 15px 30px;
    color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.nav-list {
    list-style: none;
    display: flex;
    gap: 25px;
    margin: 0;
    padding: 0;
}

.nav-list li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.nav-list li a:hover {
    color: #bbdefb;
}

.edit-container {
    max-width: 800px;
    margin: 40px auto;
    background-color: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
}

.form-title {
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #0d47a1;
}

.edit-form label {
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
    font-weight: bold;
}

.edit-form input[type="text"],
.edit-form textarea {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
}

.edit-form input[type="submit"] {
    margin-top: 25px;
    padding: 12px 30px;
    background-color: #2196f3;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.edit-form input[type="submit"]:hover {
    background-color: #1769aa;
}

.error-msg {
    background-color: #ffdddd;
    color: #c62828;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.site-footer {
    text-align: center;
    font-size: 0.9rem;
    color: #888;
    padding: 25px 0;
    background-color: #f1f1f1;
    margin-top: 60px;
}

