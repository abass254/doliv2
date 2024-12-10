import json
from datetime import datetime

# Input and output file paths
input_file = 'file.json'  # Replace with your input JSON file path
output_file = 'output.json'  # Replace with your output JSON file path

def process_date_of_loss(data):
    for record in data:
        if not isinstance(record, dict):  # Ensure the record is a dictionary
            continue  # Skip malformed entries

        # Get the date_of_loss value
        date_of_loss = record.get('date_of_loss')

        if not date_of_loss or not isinstance(date_of_loss, str) or not date_of_loss.strip():
            # Set default date for empty, null, or invalid `date_of_loss`
            record['date_of_loss'] = '01-01-2010'
        else:
            try:
                # Convert to d-m-Y format
                date_obj = datetime.strptime(date_of_loss.strip(), "%d %B, %Y")
                record['date_of_loss'] = date_obj.strftime('%d-%m-%Y')
            except ValueError:
                # If parsing fails, keep the original value or log the error
                print(f"Invalid date format for record: {record}")
    return data

# Read the JSON file
with open(input_file, 'r') as infile:
    data = json.load(infile)

# Process the dates
processed_data = process_date_of_loss(data)

# Write back to a new JSON file
with open(output_file, 'w') as outfile:
    json.dump(processed_data, outfile, indent=4)

print(f"Processed JSON saved to {output_file}")
