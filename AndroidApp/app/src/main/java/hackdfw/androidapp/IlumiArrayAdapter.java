package hackdfw.androidapp;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;

public class IlumiArrayAdapter extends ArrayAdapter<byte[]> {

    // Support the ViewHolder pattern to prevent the needless re-allocation of memory.
    private static class ViewHolder {
        TextView macAddress;
    }

    static private char[] charArray = {
        '0', '1', '2', '3',
        '4', '5', '6', '7',
        '8', '9', 'A', 'B',
        'C', 'D', 'E' , 'F'
    };

    private static char NibbleToChar(int data) {
        return charArray[data & 0xF];
    }

    // Format raw mac address bytes to a human readable form.
    public static String bytesToString(byte[] mac) {

        if(mac != null && mac.length > 0) {

            char[] result = new char[(mac.length*3)-1];
            int temp;

            for(int i = 0; i < mac.length; i++) {

                temp = mac[mac.length-1-i] & 0x0F;
                result[i*3+1] = NibbleToChar(temp);

                temp = mac[mac.length-1-i] >> 4;
                result[i*3] = NibbleToChar(temp);

                if( (i+1) < mac.length ) {
                    result[i*3+2] = ':';
                }
            }

            return new String(result);
        }else{
            return "null";
        }
    }

    public IlumiArrayAdapter(Context context, ArrayList<byte[]> ilumi) {

		super(context, 0, ilumi);
	}

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        // Get the data item for this position and format it for the view.
        byte[] macAddressBytes = getItem(position);
        String macAddress = "ilumi <" + IlumiArrayAdapter.bytesToString(macAddressBytes) + ">";

        // Check if an existing view is being reused, otherwise inflate the view.
        ViewHolder viewHolder;

        if (convertView == null) {
            viewHolder = new ViewHolder();
            LayoutInflater inflater = LayoutInflater.from(getContext());
            convertView = inflater.inflate(R.layout.ilumi_list_item, parent, false);
            viewHolder.macAddress = (TextView) convertView.findViewById(R.id.mac_address);

            // Cache the view holder in tag.
            convertView.setTag(viewHolder);
        } else {
            // Existing view holders are cached in the tag property.
            viewHolder = (ViewHolder) convertView.getTag();
        }

        // Populate the data into the template view using the data object.
        viewHolder.macAddress.setText(macAddress);

        // Return the completed view to render on screen.
        return convertView;
	}
}