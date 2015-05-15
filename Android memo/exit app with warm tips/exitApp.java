//method one:
//exit app by caculating timesgap
final int mDuraction = 2000; // 两次返回键之间的时间差
long mLastTime = 0; // 最后一次按back键的时刻

@Override
public boolean onKeyDown(int keyCode, KeyEvent event) {
if(keyCode == KeyEvent.KEYCODE_BACK) {// 截获back事件

exitApp();
return true;
} else {
return super.onKeyDown(keyCode, event);
}
}

private void exitApp() {

if(System.currentTimeMillis() - mLastTime > mDuraction) {
Toast.makeText(this, "再按一次退出", 0).show();
mLastTime = System.currentTimeMillis();
} else {
finish();
}
}

//method two:
//exit app by timer
final int mDuraction = 2000; // 两次返回键之间的时间差
private boolean isExit = false;
private Timer mTicker = null;
@Override
public boolean onKeyDown(int keyCode, KeyEvent event) {
if(keyCode == KeyEvent.KEYCODE_BACK) {// 截获back事件

exitByTimeTicker();
return true;
} else {
return super.onKeyDown(keyCode, event);
}
}

private void exitByTimeTicker() {

if(isExit) { // 退出应用

finish();
} else {
// 第一次按back键，弹出提示
Toast.makeText(getApplicationContext(), "再按一次退出", 0).show();

isExit = !isExit;
if(null == mTicker) {
mTicker = new Timer();
}

mTicker.schedule(new TimerTask() {
@Override
public void run() {
isExit = false; // 改变标识
}
}, mDuraction); // 如果第一次按back 2秒后没操作，则使用计时器取消退出操作的标识
}

}

//method two:
//exit app by Handler
final int mDuraction = 2000; // 两次返回键之间的时间差
private final int MSG_EXIT = 0x0808;
private final int MSG_EXIT_WAIT = 0x0810;

@Override
public boolean onKeyDown(int keyCode, KeyEvent event) {
if(keyCode == KeyEvent.KEYCODE_BACK) {// 截获back事件

mHandler.sendEmptyMessage(MSG_EXIT);
return true;
} else {
return super.onKeyDown(keyCode, event);
}
}

private Handler mHandler = new Handler(){

public void handleMessage(Message msg) {
switch (msg.what) {
case MSG_EXIT:
if(this.hasMessages(MSG_EXIT_WAIT)) {
// 如果MSG_EXIT_WAIT 还存在MessageQueue中，说明已经按了一次Back键，那么就finish当前activity
finish();
} else {

Toast.makeText(getApplicationContext(), "再按一次退出", 0).show();
this.sendEmptyMessageDelayed(MSG_EXIT_WAIT, mDuraction);
}
break;
case MSG_EXIT_WAIT:
break;
default:
break;
}
};
};
//reference:http://blog.csdn.net/qq3162380/article/details/41799907

