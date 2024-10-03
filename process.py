import json

def main():
    data = {
        "message": "Hello from Python script!",
        "status": "success"
    }
    print(json.dumps(data))

if __name__ == "__main__":
    main()