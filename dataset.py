import cv2
import os
import sys

if len(sys.argv) < 3 or sys.argv[2] != "start_capture":
    print("Script triggered without start capture parameter.")
    sys.exit(1)

person_code = sys.argv[1]
face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
dataset_directory = 'dataset_wajah'
if not os.path.exists(dataset_directory):
    os.makedirs(dataset_directory)

# Hanya ambil satu gambar
video_capture = cv2.VideoCapture(0)
image_saved = False  # Untuk memastikan hanya satu gambar disimpan

while not image_saved:
    ret, frame = video_capture.read()
    gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(gray_frame, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    for (x, y, w, h) in faces:
        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)
        face = frame[y:y+h, x:x+w]
        face_filename = os.path.join(dataset_directory, f"{person_code}.jpg")
        cv2.imwrite(face_filename, face)
        print("File sudah disimpan")  # Tampilkan pesan setelah menyimpan
        image_saved = True
        break

    cv2.imshow('Video', frame)
    if cv2.waitKey(1) & 0xFF == ord('q') or image_saved:
        break

video_capture.release()
cv2.destroyAllWindows()
