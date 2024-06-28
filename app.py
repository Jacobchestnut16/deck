import os
import subprocess
import sys
from PyQt5.QtCore import QUrl, Qt
from PyQt5.QtWidgets import QApplication, QMainWindow, QWebEngineView

class WebAppViewer(QMainWindow):
    def __init__(self, url):
        super().__init__()
        self.setWindowTitle("Web App Viewer")
        self.setGeometry(100, 100, 800, 600)  # Adjust dimensions as needed
        self.browser = QWebEngineView()
        self.setCentralWidget(self.browser)
        self.browser.load(QUrl(url))
        self.showFullScreen()

def update_and_launch_webapp():
    # Step 1: Delete existing content in /var/www/html/deck/
    deck_path = '/var/www/html/deck/'
    try:
        subprocess.run(['rm', '-rf', deck_path], check=True)
    except subprocess.CalledProcessError as e:
        print(f"Error deleting {deck_path}: {e}")
        return

    # Step 2: Clone Git repository
    try:
        subprocess.run(['git', 'clone', 'https://github.com/yourusername/yourwebapp.git', deck_path], check=True)
    except subprocess.CalledProcessError as e:
        print(f"Error cloning repository: {e}")
        return

    # Step 3: Launch web app in full-screen using PyQt
    url = 'http://localhost/deck/'  # Adjust URL based on your setup
    app = QApplication(sys.argv)
    window = WebAppViewer(url)
    sys.exit(app.exec_())

if __name__ == '__main__':
    update_and_launch_webapp()
