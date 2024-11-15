import cv2
import pytesseract
import os
import numpy as np

# Inisialisasi model pengenalan wajah
face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
dataset_directory = 'dataset_wajah'

# Fungsi untuk mengenali wajah berdasarkan dataset
def recognize_face(face_region):
    people = [person for person in os.listdir(dataset_directory) if os.path.isdir(os.path.join(dataset_directory, person))]
    label = "Unknown"

    for person in people:
        person_folder = os.path.join(dataset_directory, person)
        person_images = os.listdir(person_folder)
        if len(person_images) > 0:
            known_face = cv2.imread(os.path.join(person_folder, person_images[0]), cv2.IMREAD_GRAYSCALE)
            res = cv2.matchTemplate(face_region, known_face, cv2.TM_CCOEFF_NORMED)
            threshold = 0.7
            loc = np.where(res >= threshold)

            if loc[0].size > 0:
                label = person
                break

    return label

# Fungsi untuk memproses gambar dan mendeteksi wajah
def recognize_faces_in_image(image_path):
    img = cv2.imread(image_path)

    # Deteksi wajah
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    recognized_name = "Tidak dikenali"
    for (x, y, w, h) in faces:
        face_region = gray[y:y+h, x:x+w]
        recognized_name = recognize_face(face_region)
        break  # Ambil wajah pertama yang dikenali

    return recognized_name

# Fungsi OCR untuk mendeteksi jumlah uang
def detect_amount_in_image(image_path):
    img = cv2.imread(image_path)

    # Ubah gambar ke grayscale untuk OCR
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # Gunakan pytesseract untuk ekstraksi teks
    text = pytesseract.image_to_string(gray, config='--psm 6')

    # Cek apakah ada angka dalam teks yang ditemukan
    amount = ''.join([char for char in text if char.isdigit()])
    return amount if amount else "Tidak terdeteksi"

# Fungsi utama untuk menjalankan face recognition dan OCR secara bersamaan
def process_image(image_path):
    # Proses pengenalan wajah
    recognized_name = recognize_faces_in_image(image_path)
    
    # Proses deteksi jumlah uang menggunakan OCR
    detected_amount = detect_amount_in_image(image_path)

    # Kembalikan hasil
    return {
        "nama": recognized_name,
        "amount": detected_amount
    }

# Contoh penggunaan
if __name__ == '__main__':
    image_path = '111111.jpg'  # Ganti dengan path gambar yang ingin diuji
    result = process_image(image_path)
    
    print(f'Wajah yang dikenali: {result["nama"]}')
    print(f'Jumlah uang yang terdeteksi: {result["amount"]}')
