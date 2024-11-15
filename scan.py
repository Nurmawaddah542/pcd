from flask import Flask, request, jsonify
import cv2
import pytesseract
import numpy as np
import face_recognition # type: ignore
import os

# Mengimpor fungsi untuk memeriksa folder
from check_face_dataset import check_face_dataset

# Konfigurasi pytesseract jika diperlukan
pytesseract.pytesseract.tesseract_cmd = r"C:\Program Files\Tesseract-OCR\tesseract.exe"

app = Flask(__name__)

# Muat data wajah yang dikenal dari folder dataset
known_face_encodings = []
known_face_names = []

# Memeriksa dan mencetak isi folder face_dataset
files_in_dataset = check_face_dataset("face_dataset")

# Memproses gambar jika ada file di folder face_dataset
for file_name in files_in_dataset:
    image_path = os.path.join("face_dataset", file_name)
    if os.path.isfile(image_path):
        try:
            image = face_recognition.load_image_file(image_path)
            encodings = face_recognition.face_encodings(image)
            if encodings:  # Pastikan ada encoding wajah
                known_face_encodings.append(encodings[0])
                # Nama dikenali dari nama file (misal: file "John_Doe.jpg" akan memberi nama "John Doe")
                known_face_names.append(os.path.splitext(file_name)[0].replace("_", " "))
        except Exception as e:
            print(f"Error saat memproses file {file_name}: {e}")

# Fungsi untuk melakukan OCR pada mata uang
def perform_ocr(image):
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    _, thresh = cv2.threshold(gray, 150, 255, cv2.THRESH_BINARY)
    text = pytesseract.image_to_string(thresh, config='--psm 6')
    amount = ''.join(filter(str.isdigit, text))  # Hanya mengambil digit
    return amount if amount else "Tidak terdeteksi"

@app.route('/scan', methods=['POST'])
def scan_currency():
    if 'image' not in request.files:
        return jsonify({"error": "No image provided"}), 400

    # Membaca gambar dari request
    image_file = request.files['image']
    image_bytes = image_file.read()
    npimg = np.frombuffer(image_bytes, np.uint8)
    image = cv2.imdecode(npimg, cv2.IMREAD_COLOR)

    # Deteksi Wajah
    face_locations = face_recognition.face_locations(image)
    face_encodings = face_recognition.face_encodings(image, face_locations)

    matched_name = "Tidak dikenali"
    for face_encoding in face_encodings:
        matches = face_recognition.compare_faces(known_face_encodings, face_encoding)
        face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
        best_match_index = np.argmin(face_distances)
        if matches[best_match_index]:
            matched_name = known_face_names[best_match_index]

    # Lakukan OCR pada gambar
    amount = perform_ocr(image)

    # Kembalikan hasil
    return jsonify({"nama": matched_name, "amount": amount})

if __name__ == '__main__':
    app.run(debug=True)
