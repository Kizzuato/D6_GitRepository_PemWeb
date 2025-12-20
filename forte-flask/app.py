from flask import Flask, request, jsonify

app = Flask(__name__)

# -----------------------------
# UTILITIES
# -----------------------------

def is_number(value):
    return isinstance(value, int) or isinstance(value, float)


# -----------------------------
# HEALTH CHECK
# -----------------------------
@app.route("/health", methods=["GET"])
def health():
    return jsonify({
        "service": "forte-flask",
        "status": "running"
    })


# -----------------------------
# CORE ANALYSIS ENDPOINT
# -----------------------------
@app.route("/analyze/sensor", methods=["POST"])
def analyze_sensor():
    """
    Endpoint utama analisis Forte
    Dipanggil oleh Laravel
    """

    data = request.json

    # Ambil data sensor
    temperature = data.get("temperature")      # DHT22 / BME280
    humidity = data.get("humidity")            # DHT22 / BME280
    pressure = data.get("pressure")            # BMP180
    light = data.get("light")                  # BH1750
    voltage = data.get("voltage")              # Voltage sensor
    accel = data.get("accel")                  # IMU (dict: x,y,z)

    anomaly = False
    zone = "normal"
    description = []

    # -----------------------------
    # ANALISIS SUHU & KELEMBAPAN
    # -----------------------------
    if is_number(temperature) and is_number(humidity):
        if temperature > 35:
            anomaly = True
            zone = "hot"
            description.append("Suhu terlalu tinggi")

        if humidity > 85:
            anomaly = True
            zone = "humid"
            description.append("Kelembapan terlalu tinggi")

        if temperature < 15:
            anomaly = True
            zone = "cold"
            description.append("Suhu terlalu rendah")

    # -----------------------------
    # ANALISIS TEKANAN UDARA
    # -----------------------------
    if is_number(pressure):
        if pressure < 950:
            description.append("Tekanan udara rendah (potensi cuaca buruk)")

    # -----------------------------
    # ANALISIS CAHAYA
    # -----------------------------
    if is_number(light):
        if light < 100:
            description.append("Area minim cahaya")
        elif light > 10000:
            description.append("Cahaya sangat tinggi (terbuka penuh)")

    # -----------------------------
    # ANALISIS DAYA
    # -----------------------------
    if is_number(voltage):
        if voltage < 10.5:
            anomaly = True
            zone = "power_risk"
            description.append("Tegangan rendah, risiko mati daya")

    # -----------------------------
    # ANALISIS IMU (GERAKAN)
    # -----------------------------
    if isinstance(accel, dict):
        ax = accel.get("x")
        ay = accel.get("y")
        az = accel.get("z")

        if all(is_number(v) for v in [ax, ay, az]):
            magnitude = (ax**2 + ay**2 + az**2) ** 0.5

            if magnitude > 20:
                anomaly = True
                zone = "movement_anomaly"
                description.append("Pergerakan tidak normal terdeteksi")

    # -----------------------------
    # FINAL RESPONSE
    # -----------------------------
    return jsonify({
        "anomaly": anomaly,
        "zone": zone,
        "description": "; ".join(description) if description else "Kondisi normal"
    })


# -----------------------------
# RUN SERVER
# -----------------------------
if __name__ == "__main__":
    app.run(
        host="0.0.0.0",
        port=5000,
        debug=True
    )