import sys
minutes = int(sys.argv[1])

def convert(minutes):
	return (minutes * 60)

sys.exit(convert(minutes))