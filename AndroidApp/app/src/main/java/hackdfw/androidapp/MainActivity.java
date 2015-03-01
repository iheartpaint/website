package hackdfw.androidapp;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;

import com.ilumi.sdk.IlumiSDK;
import com.ilumi.sdk.IlumiSDKDelegate;

import java.util.ArrayList;

public class MainActivity extends ActionBarActivity implements IlumiSDKDelegate {

    protected static final String LOG_TAG = "MainActivity";

    private IlumiArrayAdapter ilumiArrayAdaptor;
    private ArrayList<byte[]> ilumi = new ArrayList<byte[]>();

    private final int ILUMI_ACTIVITY = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ilumiArrayAdaptor = new IlumiArrayAdapter(this, this.ilumi);

        ListView lv = (ListView) findViewById(R.id.ilumiListView);
        lv.setAdapter(ilumiArrayAdaptor);

        lv.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                TextView macAddressTextView = (TextView) view.findViewById(R.id.mac_address);

                byte[] macAddressBytes = ilumiArrayAdaptor.getItem(position);

                Intent ilumiControlScreen = new Intent(getApplicationContext(), IlumiActivity.class);

                Bundle bundle = new Bundle();
                bundle.putByteArray("macAddressBytes", macAddressBytes);
                bundle.putString("macAddressString", macAddressTextView.getText().toString());
                ilumiControlScreen.putExtras(bundle);

                startActivityForResult(ilumiControlScreen, ILUMI_ACTIVITY);
            }
        });

        IlumiSDK.sharedManager().setDelegate(this);
        IlumiSDK.sharedManager().startSearchIlumi();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @Override
    public void didFindiLumi(final byte[] macAddress, final boolean isCommissioned, final int iLumiType) {

        runOnUiThread(new Runnable() {

            public void run() {

                if(ilumi.contains(macAddress)) {
                    Log.d(LOG_TAG, "Found ilumi, but it's already in the list.");
                } else {
                    Log.d(LOG_TAG, "Found new ilumi! Added it to the list.");
                    ilumiArrayAdaptor.add(macAddress);
                }
            }
        });
    }

    @Override
    public void didConnectediLumi(byte[] macAddress) {

        // Do nothing...
    }

    @Override
    public void didDisconnectediLumi(final byte[] macAddress) {

        runOnUiThread(new Runnable() {

            public void run() {

                if(ilumi.contains(macAddress)) {
                    Log.d(LOG_TAG, "Disconnected ilumi removed from list.");
                    ilumiArrayAdaptor.remove(macAddress);
                }
            }
        });
    }

    @Override
    public void bluetoothNotEnabled() {

    }
}
